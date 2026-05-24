<?php

namespace Bukubuku\Core;

use Bukubuku\Models\User;

class Application
{
    static public Application $app;

    public Request $request;
    public Response $response;
    public Session $session;
    public Router $router;
    public Database $db;
    public string $rootDirectory;

    public function __construct(string $dsn, string $username, string $password, string $rootDirectory)
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router();
        $this->db = new Database($dsn, $username, $password);
        $this->rootDirectory = $rootDirectory;

        Application::$app = $this;
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $exception) {
            echo (new View())->render('error');
        }
    }

    //Write to the flash memory (encapsulates session).
    public function setFlashMemory($key, $value)
    {
        $this->session->setFlashMemory($key, $value);
    }

    //Read from the flash memory (encapsulates session).
    public function getFlashMemory($key)
    {
        return $this->session->getFlashMemory($key);
    }

    //Write a success message to the flash memory.
    public function setFlashSuccessMessage(string $message)
    {
        $this->session->setFlashMemory('success', $message);
    }

    //Read the success message from the flash memory.
    public function getFlashSuccessMessage(): string
    {
        return $this->session->getFlashMemory('success');
    }

    //Write an error message to the flash memory.
    public function setFlashErrorMessage(string $message)
    {
        $this->session->setFlashMemory('error', $message);
    }

    //Read the error message from the flash memory.
    public function getFlashErrorMessage(): string
    {
        return $this->session->getFlashMemory('error');
    }

    //Login the user.
    public function login(int $userId)
    {
        $this->session->login($userId);
    }

    //Logout the user.
    public function logout()
    {
        $this->session->logout();
    }

    //Get the ID of the (logged in) user.
    public function getUserId(): int|null
    {
        return $this->session->get('userId');
    }

    //Is the user a guest?
    public function isGuest(): bool
    {
        if ($this->getUserId() == null) {
            return true;
        } else {
            return false;
        }
    }

    //Get the full name of the (logged in) user.
    public function getFullName(): string
    {
        if (!$this->isGuest()) {
            $user = User::fromDatabase(Application::$app->getUserId());
            return $user->getFullName();
        } else {
            return '';
        }
    }
}
