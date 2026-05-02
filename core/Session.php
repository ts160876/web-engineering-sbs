<?php

namespace Bukubuku\Core;

class Session
{

    private const FLASH_MEMORY_KEY = 'flashMemory';

    public function __construct()
    {
        session_start();

        /*The constructor of the Session class is called at the beginning of any HTTP request.
Everything stored in the flash memory at this point of time, needs to be removed at the
end of the HTTP request. Therefore it is marked correspondingly.*/
        $flashMemory = $_SESSION[Session::FLASH_MEMORY_KEY] ?? [];
        foreach ($flashMemory as $key => &$content) {
            $content['remove'] = true;
        }
        $_SESSION[Session::FLASH_MEMORY_KEY] = $flashMemory;
    }

    public function __destruct()
    {
        /*The destructor of the Session class is called at the end of any HTTP request.
    Everything which was stored in the flash memory at the beginning of the HTTP request,
    is now removed from the flash memory. */
        $flashMemory = $_SESSION[Session::FLASH_MEMORY_KEY] ?? [];
        foreach ($flashMemory as $key => $content) {
            if ($content['remove'] == true) {
                unset($flashMemory[$key]);
            }
        }
        $_SESSION[Session::FLASH_MEMORY_KEY] = $flashMemory;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function unset($key)
    {
        unset($_SESSION[$key]);
    }

    public function setFlashMemory(string $key, $value)
    {
        $_SESSION[Session::FLASH_MEMORY_KEY][$key] = [
            'value' => $value,
            'remove' => false
        ];
    }

    public function getFlashMemory(string $key)
    {
        return $_SESSION[Session::FLASH_MEMORY_KEY][$key]['value'] ?? null;
    }
}
