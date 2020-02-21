<?php


namespace App;


use App\Classes\Database;
use App\Classes\Renderer;
use App\Classes\Request;
use App\Classes\Router;

class Application
{
    private $request;
    private $renderer;
    private $response;
    private $router;
    private $database;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->renderer = new Renderer();
        $this->router = Router::getInstance();
        $this->database = Database::getInstance();


    }

    public function handle()
    {
        try {
            $content = $this->matchRoute($this->request->getPath());
        } catch (\Exception $e) {
            $content = $e->getMessage();
        }
        $this->respond($content);
    }

    private function matchRoute($url)
    {
        return $this->router->getRoute($url, $this->renderer, $this->request);
    }

    private function respond(?string $response)
    {
        echo $response;
    }
}
