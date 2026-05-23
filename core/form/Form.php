<?php

namespace Bukubuku\Core\Form;

use Bukubuku\Core\Model;

class Form
{

    public string $action;
    public string $method;
    public Model $model;
    public bool $readonly;
    public function __construct(string $action, string $method, Model $model, bool $readonly = false)
    {
        $this->action = $action;
        $this->method = $method;
        $this->model = $model;
        $this->readonly = $readonly;
    }

    //Print the start tag of the form.
    public function start(): string
    {
        return sprintf('<form action="%s" method="%s">', htmlspecialchars($this->action), htmlspecialchars($this->method)) . PHP_EOL;
    }

    //Print the end tag of the form.
    public function end(): string
    {
        return '</form>' . PHP_EOL;
    }

    public function button(string $type, string $buttonName, string $buttonText, bool $readonly = false): Button
    {
        $button = new Button($type, $buttonName, $buttonText, $this, $readonly);
        return $button;
    }

    public function field(string $type, string $propertyName, bool $readonly = false): Field
    {
        $field = new Field($type, $propertyName, $this, $readonly);
        return $field;
    }

    public function textarea(string $propertyName, bool $readonly = false): Textarea
    {
        $textarea = new Textarea($propertyName, $this, $readonly);
        return $textarea;
    }
}
