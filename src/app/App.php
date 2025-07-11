<?php 

declare(strict_types= 1);


namespace App;


class App 
{
    private static DB2 $db;

    public function __construct(protected Router $router, protected array $request, protected Config $config)
    {
        static::$db = new DB2($config->db ?? []);
    }

    public static function db(): DB2
    {
        return static::$db;
    } 

    public function run()
    {
        try {
            echo $this->router->resolve(
                $this->request['uri'],
                strtolower($this->request['method'])
            );
        } catch (\App\ErrorH\RouteNotFoundException $e) {
            http_response_code(404);

            echo $e->getMessage();
        }
    }
}