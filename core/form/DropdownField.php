<?php

namespace Bukubuku\Core\Form;


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
