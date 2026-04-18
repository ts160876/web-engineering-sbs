<?php

namespace Bukubuku\Core;

class View
{
    //Render the view.
    public function render(string $view, array $parameters = []): string
    {
        //Start output buffering.
        ob_start();

        include_once Application::$app->rootDirectory . '/views/' . $view . '.php';

        //Return the content from the buffer and clear the buffer.
        return ob_get_clean();
    }
}
