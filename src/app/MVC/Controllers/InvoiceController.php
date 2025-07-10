<?php 

namespace App\MVC\Controllers;

use App\MVC\View;

class InvoiceController
{
    protected float $amount;
    protected string $description;

    public function __construct(float $amount = 0,string $description = "No description provided"){
        $this->amount = $amount;
        $this->description = $description;
    }

    public function index(): view
    {
        return View::make('invoices/index');
    }

    public function create(): view
    {

        return View::make('invoices/create');

    }

    public function store() {
        $amount = $_POST['amount'] ?? 0;
        $description = $_POST['description'] ?? 'No description provided';

        var_dump("Storing invoice with amount: {$amount} and description: {$description}");
        echo "<br>";
    }



   
}