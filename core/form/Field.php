<?php

namespace Bukubuku\Core\Form;

class Field
{
    //Currently we only support the following types. Additional ones could be added.
    public const TEXT = 'text';
    public const EMAIL = 'email';
    public const PASSWORD = 'password';
    public const DATE = 'date';
    public const DATETIME = 'datetime-local';
    public const NUMBER = 'number';
    public const HIDDEN = 'hidden';

    //Attributes of the field
    public string $type;
    public string $propertyName;
    public bool $readonly;
    public Form $form;

    public function __construct(string $type, string $propertyName, Form $form, bool $readonly = false)
    {
        $this->type = $type;
        $this->propertyName = $propertyName;
        $this->form = $form;
        if ($form->readonly == true) {
            $this->readonly = true;
        } else {
            $this->readonly = $readonly;
        }
    }

    //Print the field.
    public function __toString()
    {

        $propertyValue = $this->form->model->{$this->propertyName};

        return sprintf(
            '<div class="mb-3">
                <label for="%s">%s</label>
                    <input type="%s" id="%s" name="%s" value="%s" %s class="form-control %s %s">
                    <div class="invalid-feedback">
                       %s
                </div>
            </div>',
            htmlspecialchars($this->propertyName),
            htmlspecialchars($this->form->model->getLabel($this->propertyName)),
            htmlspecialchars($this->type),
            htmlspecialchars($this->propertyName),
            htmlspecialchars($this->propertyName),
            htmlspecialchars($propertyValue ?? ''),
            htmlspecialchars($this->readonly ? 'readonly' : ''),
            htmlspecialchars($this->readonly ? 'bg-light' : ''),
            htmlspecialchars($this->form->model->hasError($this->propertyName) ? ' is-invalid' : ''),
            htmlspecialchars($this->form->model->getFirstError($this->propertyName))
        );
    }
}
