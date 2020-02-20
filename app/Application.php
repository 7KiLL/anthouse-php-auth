<?php


namespace App;


use App\Classes\Renderer;
use App\Classes\Request;
use App\Classes\Router;

class Application
{
    private $request;
    private $renderer;
    private $response;
    private $router;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->renderer = new Renderer();
        $this->router = Router::getInstance();
        require_once '../routes/web.php';

    }

    public function handle()
    {
//        $res = $this->renderer->render('login', []);
//        $this->respond($res);

        var_dump($this->request->getQuery());
        $content = $this->matchRoute($this->request->getPath());
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
