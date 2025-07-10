<?php 

declare(strict_types= 1);

namespace App\MVC\Models;

use App\MVC\Model;

class User extends Model
{


    public function create(string $email,string $name, bool $isActive = true): int{
        $Stmt = $this->db->prepare(
                'INSERT INTO users (email, full_name, is_active, created_at)
                VALUES (?, ?, ?, NOW())'
            );

        $Stmt->execute([$email, $name, $isActive]);

        return (int) $this->db->lastInsertId();
    }
}