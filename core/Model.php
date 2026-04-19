<?php

namespace Bukubuku\Core;

abstract class Model
{

    public array $errors = [];

    static abstract protected function getRulesets(): array;
    static abstract protected function propertyMapping(): array;

    static public function getPropertyNames(): array
    {
        return []; //TODO
    }

    static public function getLabel($property): string
    {
        return ''; //TODO
    }

    static public function fromHttp(array $data)
    {
        return new static($data['properties'] ?? [], $data['errors'] ?? []);
    }


    protected function __construct(array $properties = [], array $errors = [])
    {
        //Iterate over all parameters and split them into the name and value of the property.
        foreach ($properties as $propertyName => $propertyValue) {
            //If a property with the name exists, then we set the value of this property.
            //Otherwise we ignore this parameter.
            if (property_exists($this, $propertyName)) {
                $this->{$propertyName} = $propertyValue;
            }
        }

        //Set the messages.
        $this->errors = $errors;
    }

    public function validateData(): bool
    {
        //Reset the error messages at the beginning of the validation.
        $this->errors = [];

        /*The rulesets are stored as an associative array where the key is the name of the property to be validated.
          The value stores the rules. The rules are again an associative array.
          For each rule the key stores the name of the rule. 
          For each rule the value stores the parameters if applicable (i.e., can be an empty array).*/
        $rulesets = static::getRulesets();

        foreach ($rulesets as $property => $rules) {
            $value = $this->{$property};
            foreach ($rules as $ruleName => $parameters) {
                switch ($ruleName) {
                    case Rule::REQUIRED:
                        if (!$value) {
                            $this->addError($property, 'This field is required.');
                        }
                        break;
                    case Rule::EMAIL:
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $this->addError($property, 'This field must be a valid e-mail.');
                        }
                        break;
                }
            }
        }

        //Check if errors exist.
        return !$this->hasError();
    }

    protected function addError(string $propertyName, string $message)
    {
        $this->errors[$propertyName][] = $message;
    }

    public function hasError(string $property = ''): bool
    {
        if ($property != '') {
            if (key_exists($property, $this->errors)) {
                return true;
            } else {
                return false;
            }
        } else {
            return !empty($this->errors);
        }
    }

    public function getFirstError(string $property): string
    {
        return  $this->errors[$property][0] ?? '';
    }
}
