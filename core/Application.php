<?php

namespace Bukubuku\Core;

class Application
{
    static public Application $app;

    public Request $request;
    public Response $response;
    public Router $router;
    public string $rootDirectory;

    public function __construct(string $rootDirectory)
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router();
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
}
