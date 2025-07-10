<?php

declare(strict_types=1);

namespace App\MVC\Controllers;

use App\MVC\View;
use App\App;
use App\MVC\Models\User;
use App\MVC\Models\Invoice;
use App\MVC\Models\SignUp;
use PDO;

class HomeController
{
   

    public function index(): view
    {

        $email = 'ww@gmail.com';
        $name = 's';
        $amount = 25;

        $userModel = new User();
        $invoiceModel = new Invoice();

        $invoiceId = (new SignUp($userModel, $invoiceModel))->signUp(
            [
                'email'=> $email,
                'name'=> $name,
            ],
            [
                'amount'=> $amount,
            ]
        );


        return View::make('index',['invoice' => $invoiceModel->find($invoiceId)]);
    }   

    public function upload()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['receipt']['tmp_name'];
                $fileName = $_FILES['receipt']['name'];
                $destination = STORAGE_PATH . '/' . $_FILES['receipt']['name'];
                if (move_uploaded_file($fileTmpPath, $destination)) {
                    return "File uploaded successfully: " . htmlspecialchars($fileName);
                }
                return "Error moving uploaded file.";
            }
            return "No file uploaded or there was an upload error.";
        }   
        return "Invalid request method.";
    }

}