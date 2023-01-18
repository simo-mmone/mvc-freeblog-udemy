<?php

namespace App\Models;
use App\DB\DBPDO;

class Comment
{
    public string $message = "";
    public string $email = "";
    public string $created_at = "";
    
    public function __construct(protected DBPDO $conn)
    {
    }

    public function all(int $postid): array
    {
        $result = [];
        $stm = $this->conn->query('postscomments?order=created_at.desc&select=*&post_id=eq.'.$postid);
        
        if ($stm && count($stm) > 0) {
            $result = $stm;
        } else {
            $result = [];
        }
        return $result;
    }

    public function save(array $post, int $postid): bool
    {
        $stm = 'postscomments';
        $result = $this->conn->query(
            $stm,
            array(
                'email' => $post['email'],
                'comment' => $post['text'],
                'post_id' => $postid
            )
        );
        return true;
    }

    public function delete(int $commentid): int
    {
        $stm = 'postscomments?id=eq.'.$commentid;
        $result = $this->conn->query(
            $stm,
            array(),
            'DELETE'
        );
        return true;
    }
}
