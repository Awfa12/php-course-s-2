<?php 


namespace App;

use PDO;

class DB2
{
    private PDO $pdo;

    public function __construct(array $config){
        $defaultOptions = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['database'];
            
            $this->pdo = new PDO(
                $dsn,
                $config['user'],
                $config['pass'],
                $options ?? $defaultOptions
            );
            
        } catch (\PDOException $e) {
            throw new \Exception(''. $e->getMessage(), (int) $e->getCode());
        }
    }

    public function __call(string $name,array $args) {
        return call_user_func_array([$this->pdo, $name], $args);
    }

}