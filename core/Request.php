<?php

namespace Bukubuku\Core;

class Request
{
    public function getPath(): string
    {
        //Remove the script name from the URI.
        $path = substr($this->getRequestUri(), strlen($this->getScriptName()));

        /*Remove the query string. Thereto, split the path into an array using '?' as delimiter.
        Use the substring at index 0 of the array.*/
        $path = explode('?', $path)[0];

        //If the path is empty, consider '/' to be the path.
        $path = $path !== '' ? $path : '/';

        return $path;
    }

    public function getRequestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getRequestUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getScriptName(): string
    {
        return $_SERVER['SCRIPT_NAME'];
    }
}
