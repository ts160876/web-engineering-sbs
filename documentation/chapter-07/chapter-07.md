# Chapter 07: Improve User model

In this chapter we will implement several improvements for the `User` model.

## Add support for dropdown fields (30 min)

The field to select the user role shall be a dropdown field. For this you implement a class `DropdownField` in namespace `Bukubuku\Core\Form`.

```
class DropdownField
{
    //Attributes of the button
    public string $propertyName;
    public array $options;
    public bool $readonly;
    public Form $form;

    public function __construct(string $propertyName, array $options, Form $form, bool $readonly = false)
    {
        $this->propertyName = $propertyName;
        $this->options = $options;
        $this->form = $form;
        if ($form->readonly == true) {
            $this->readonly = true;
        } else {
            $this->readonly = $readonly;
        }
    }

    //Print the dropdown field.
    public function __toString()
    {
        //Generate the available dropdown values based on the options property.
        $optionString = '';
        foreach ($this->options as $optionValue => $optionText) {
            $optionString .= sprintf(
                '<option value="%s" %s>%s</option>',
                htmlspecialchars($optionValue),
                htmlspecialchars($this->form->model->{$this->propertyName} == $optionValue ? 'selected' : ''),
                htmlspecialchars($optionText)
            );
        }

        return sprintf(
            '<div class="mb-3">
              <label for="%s">%s</label>
              <select id="%s" name="%s" %s class="form-select %s">
                %s
              </select>
              <div class="invalid-feedback">
                %s
              </div>
            </div>',
            htmlspecialchars($this->propertyName),
            htmlspecialchars($this->form->model->getLabel($this->propertyName)),
            htmlspecialchars($this->propertyName),
            htmlspecialchars($this->propertyName),
            /*We assume that the value of a disabled dropdown field is not needed.
            That will not necessarily hold true in productive environments.*/
            htmlspecialchars($this->readonly ? 'disabled' : ''),
            htmlspecialchars($this->form->model->hasError($this->propertyName) ? ' is-invalid' : ''),
            $optionString,
            htmlspecialchars($this->form->model->getFirstError($this->propertyName))
        );
    }
}
```

Then enhance the `Form` class by an additional method:

```
    public function dropdownField(string $propertyName, array $options, bool $readonly = false): DropdownField
    {
        $dropdownField = new DropdownField($propertyName, $options, $this, $readonly);
        return $dropdownField;
    }
```

The dropdown field expects an `array $options` with all available options that shall be displayed. To populate the array, we create an additional method in the `User` class:

```
    static public function getIsAdminDropdown(): array
    {
        return [
            0 => 'Customer',
            1 => 'Administrator'
        ];
    }
```

Finally adjust the `create.php` file to make use of the dropdown field:

```
<?= $form->dropdownField('isAdmin', User::getIsAdminDropdown()) ?>
```

Test the form.

## Add additional validations (30 min)

We need four additional validations:

- Validation of the minimum length of the value
- Validation of the maximum length of the value
- Validation that a value matches another value; example: the fields to enter the password and confirm the password have to match
- Validation that a value is unique; example: there must not be multiple users with the same email

First enhance the `Rule` class by additional constants:

```
    public const MIN_LENGTH = 'minLength';
    public const MAX_LENGTH = 'maxLength';
    public const MATCH = 'match';
    public const UNIQUE = 'unique';
```

Create an additiona class `RuleParameter`:

```
class RuleParameter
{
    public const MIN = 'min';
    public const MAX = 'max';
    public const MATCH = 'match';
}
```

Then enhance the `validateData` method of the `Model` class with the first three validations:

```
                    case Rule::MIN_LENGTH;
                        if (strlen($value) < $parameters[RuleParameter::MIN]) {
                            $this->addError($property, 'The value is too short.');
                        }
                        break;
                    case Rule::MAX_LENGTH;
                        if (strlen($value) > $parameters[RuleParameter::MAX]) {
                            $this->addError($property, 'The value is too long.');
                        }
                        break;
                    case Rule::MATCH:
                        if ($value !== $this->{$parameters[RuleParameter::MATCH]}) {
                            $this->addError($property, 'The value does not match.');
                        }
                        break;
```

The forth validation belongs to the `DatabaseModel` class, because it requires to access the database. Hence you need to overwrite the `validateData` method:

```
    public function validateData(): bool
    {
        //First call the validations implemented in the Model class.
        parent::validateData();

        $rulesets = static::getRulesets();

        foreach ($rulesets as $property => $rules) {
            foreach ($rules as $ruleName => $parameters) {
                switch ($ruleName) {
                    case Rule::UNIQUE:
                        if ($this->isUnique($property) != true) {
                            $this->addError($property, 'Value already exists.');
                        }
                        break;
                }
            }
        }

        //Check if errors exist.
        return !$this->hasError();
    }

```

Finally adjust the `getRulesets` method of the `User` class:

```
    static protected function getRulesets(): array
    {
        return [
            'firstName' => [
                Rule::REQUIRED => [],
                Rule::MAX_LENGTH => [RuleParameter::MAX => 100]
            ],
            'lastName' => [
                Rule::REQUIRED => [],
                Rule::MAX_LENGTH => [RuleParameter::MAX => 100]
            ],
            'email' => [
                Rule::REQUIRED => [],
                Rule::MAX_LENGTH => [RuleParameter::MAX => 100],
                Rule::EMAIL => [],
                Rule::UNIQUE => []
            ],
            'password' => [
                Rule::REQUIRED => [],
                //To allow easier testing, we allow very short passwords.
                Rule::MIN_LENGTH => [RuleParameter::MIN => 3],
                Rule::MAX_LENGTH => [RuleParameter::MAX => 100]
            ],
            'confirmPassword' => [
                Rule::REQUIRED => [],
                Rule::MATCH => [RuleParameter::MATCH => 'password']
            ]
        ];
    }
```

Test the form.

## Hash the password during save (30 min)

As you know, it is not good to store the password in clear text. It is more secure to hash passwords before storing them.
Let's do this as follows:

- Add an additional property to the `User` model:

```
public string $hashedPassword = '';
```

- Adjust the colum mapping as follows:

```
'pwd' => 'hashedPassword',
```

- Overwrite the `insert` method in the `User` class:

```
    public function insert(): bool
    {
        //We need to hash the password.
        $this->hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::insert();
    }
```

- Overwrite the `update` method in the `User` class:

```
    public function update(array $properties = []): bool
    {
        //We need to hash the password.
        $this->hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::update($properties);
    }
```

- Also add a method to verify the password to the `User` class:

```
    public function checkPassword($password): bool
    {
        if (password_verify($password, $this->hashedPassword)) {
            return true;
        } else {
            return false;
        }
    }
```

Test the form.
