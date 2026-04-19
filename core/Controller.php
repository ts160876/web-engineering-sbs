<?php

namespace Bukubuku\Core;

class Controller
{
    public function renderView(string $view, array $parameters = []): string
    {
        return (new View())->render($view, $parameters);
    }
}
