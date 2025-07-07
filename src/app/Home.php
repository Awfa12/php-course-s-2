<?php

declare(strict_types=1);

namespace App;

class Home
{
    public function index(): string
    {
        
        $_SESSION['count'] = ($_SESSION['count'] ?? 0) + 1;
        echo 'Welcome to the Home Page!' . '<br>';
         // Set a cookie for 1 hour
        return <<<FORM
<form method="post" action="/upload" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="file" name="receipt" />
    <br>
    <button type="submit">Submit</button>
</form>
FORM;
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