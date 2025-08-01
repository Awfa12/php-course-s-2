<?php

declare(strict_types=1);

namespace App\MVC;

use App\ErrorH\ViewNotFoundException;

class View 
{
    public function __construct(protected string $view,protected array $params = [])
    {
        
    }

    public static function make(string $view, array $params = []): static
    {
        return new static($view, $params);
    }

    public function render(): string 
    {
        $viewPath = VIEW_PATH . '/' . $this->view . '.php';

        if(!file_exists($viewPath)){
            throw new ViewNotFoundException();
        }

        extract($this->params); // ✅ Makes $invoice available in the view

        ob_start();
        

        include $viewPath;

        return (string) ob_get_clean();
    }

    public function __toString()
    {
        return $this->render();
    }
}