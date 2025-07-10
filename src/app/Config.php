<?php 

declare(strict_types= 1);


namespace App;

/**
 * @property-read ?array $db
 */
class Config
{
    protected array $config = [];

    public function __construct(public array $env)
    {
        $this->config = [
            'db' => [
                'host' => $env['DB_HOST'], 
                'database'=> $env['DB_DATABASE'], 
                'user' => $env['DB_USERNAME'], 
                'pass' => $env['DB_PASSWORD']
            ]
        ];
    }

    public function __get(string $name)
    {
        return $this->config[$name] ?? null;
    }
}