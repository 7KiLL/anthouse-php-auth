<?php


namespace App\Classes;


class Renderer
{
    private $layout;

    private $title = 'Test application';

    private $view;

    public function __construct($layout = 'default')
    {
        $this->layout = layout($layout);
    }

    /**
     * @param string $view
     * @param array $data
     * @return string
     * @throws \Exception
     */
    public function render(string $view, array $data) : string
    {
        $view = $this->injectVariables(views($view), $data);
        return $this->injectVariables($this->layout, ['view' => $view, 'title' => $this->title]);
    }

    private function injectVariables(string $template, array $fields) : string
    {
        if (!file_exists($template)) {
            throw new \Exception("Template doesn't exists");
        }
        $content = file_get_contents($template);
        foreach ($fields as $field => $value) {
            $content = preg_replace('#{{\$'.$field.'}}#', $value, $content);
        }
        return $content;
    }
}
