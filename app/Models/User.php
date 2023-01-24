<?php

namespace App\Models;
use App\DB\DBPDO;

class User {

    public function __construct(protected DBPDO $conn)
    {
    }

    public function getUserByEmail(string $email): array
    {
        $stm = $this->conn->query('users?order=created_at.desc&select=*&email=eq.' . $email);
        
        if ($stm && count($stm) > 0) {
            $result = $stm;
        } else {
            $result = [];
        }
        return $result;
    }


}