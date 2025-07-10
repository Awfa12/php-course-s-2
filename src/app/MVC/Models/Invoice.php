<?php 

declare(strict_types= 1);

namespace App\MVC\Models;

use App\MVC\Model;

class Invoice extends Model
{


    public function create(float $amount,int $userId): int{
        $Stmt = $this->db->prepare(
                'INSERT INTO invoices(amount, user_id)
                VALUES (?, ?)'
            );
           

            $Stmt->execute([$amount, $userId]);

        return (int) $this->db->lastInsertId();
    }

    public function find(int $id)
    {
        $Stmt = $this->db->prepare(
            'SELECT invoices.id, amount, full_name
            FROM invoices
            LEFT JOIN users ON users.id = user_id
            WHERE invoices.id = ?'
        );

        $Stmt->execute([$id]);

        $invoice = $Stmt->fetch();

        return $invoice ?? [];
    }
}