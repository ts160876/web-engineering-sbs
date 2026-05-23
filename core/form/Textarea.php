<?php

namespace Bukubuku\Core\Form;

class Textarea
{
    //Attributes of the textarea
    public string $propertyName;
    public bool $readonly;
    public Form $form;

    public function __construct(string $propertyName, Form $form, bool $readonly = false)
    {
        $this->propertyName = $propertyName;
        $this->form = $form;
        if ($form->readonly == true) {
            $this->readonly = true;
        } else {
            $this->readonly = $readonly;
        }
    }

    //Print the textarea.
    public function __toString()
    {
        return sprintf(
            '<div class="mb-3">
              <label for="%s">%s</label>
              <textarea id="%s" name="%s" %s class="form-control %s %s">%s</textarea>
              <div class="invalid-feedback">
                %s
              </div>
            </div>',
            htmlspecialchars($this->propertyName),
            htmlspecialchars($this->form->model->getLabel($this->propertyName)),
            htmlspecialchars($this->propertyName),
            htmlspecialchars($this->propertyName),
            htmlspecialchars($this->readonly ? 'readonly' : ''),
            htmlspecialchars($this->readonly ? 'bg-light' : ''),
            htmlspecialchars($this->form->model->hasError($this->propertyName) ? ' is-invalid' : ''),
            htmlspecialchars($this->form->model->{$this->propertyName}),
            htmlspecialchars($this->form->model->getFirstError($this->propertyName))
        );
    }
}
