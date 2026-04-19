<?php

namespace Bukubuku\Core;

class View
{

    private const LAYOUT = '/views/layouts/main.php';

    public string $title;

    //Render the view.
    public function render(string $view, array $parameters = []): string
    {
        $viewContent = $this->getViewContent($view, $parameters);
        $layoutContent = $this->getLayoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    //Get the layout content.
    private function getLayoutContent(): string
    {
        //Start output buffering.
        ob_start();

        include_once Application::$app->rootDirectory . View::LAYOUT;

        //Return the content from the buffer and clear the buffer.
        return ob_get_clean();
    }

    //Get the view content.
    private function getViewContent(string $view, array $parameters = [])
    {
        //Start output buffering.
        ob_start();

        //Make the parameters passed to this method available to the view.
        foreach ($parameters as $key => $value) {
            $$key = $value;
        }

        include_once Application::$app->rootDirectory . '/views/' . $view . '.php';

        //Return the content from the buffer and clear the buffer.
        return ob_get_clean();
    }
}
