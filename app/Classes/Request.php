<?php


namespace App\Classes;


class Request
{
    private $url;
    private $path;
    private $method;
    private $query = [];


    public static function capture()
    {
        $raw = $_SERVER;
        $request = new self;

        $request->path = $raw["PATH_INFO"];
        $request->url = $raw["HTTP_HOST"] . $raw["REQUEST_URI"];
        $request->method = strtolower($raw["REQUEST_METHOD"]);
        $request->parseQuery($raw["QUERY_STRING"]);
        return $request;
    }

    /**
     *
     * @param string $key
     * @return array|string|null
     */
    public function getQuery(string $key = null)
    {
        if($key && isset($this->query[$key])) {
            $this->query[$key];
        } elseif(!$key) {
            return $this->query;
        } else {
            return null;
        }
    }

    private function parseQuery(string $query)
    {
        $params = preg_split('#&#', $query);
        foreach ($params as $param) {
            $tmp = preg_split('#=#', $param);
            $this->query[$tmp[0]] = $tmp[1] ?? null;
        }
    }

    public function get(string $key)
    {
        return $_GET[$key] ?? $_POST[$key] ?? null;
    }

    public function post(string $key)
    {
        return $_POST[$key] ?? $_GET[$key] ?? null;
    }

    /**
     * Returns method of captured request
     *
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method;
    }

    /**
     * Get application request URL
     *
     * @return string
     */
    public function getPath() : string
    {
        return $this->path;
    }

    /**
     * Get full path of URL
     *
     * @return string
     */
    public function getUrl() : string
    {
        return $this->url;
    }


}
