<?php

namespace Bukubuku\Core;

class Response
{

    public function getScriptName(): string
    {
        return $_SERVER['SCRIPT_NAME'];
    }

    public function redirect(string $path): void
    {
        header('Location: ' . $this->getScriptName() . $path);
    }

    public function setResponseCode(int $code): void
    {
        http_response_code($code);
    }
}
