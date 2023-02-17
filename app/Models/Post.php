<?php

namespace App\Models;
use App\DB\DbPdo;

class Post
{
    public function __construct(protected DbPdo $conn)
    {
    }

    public function all(): array
    {
        $result = [];
        $stm = $this->conn->query('posts?order=created_at.desc&select=*&limit=10');
        
        if ($stm && count($stm) > 0) {
            $result = $stm;
        } else {
            $result = [];
        }
        return $result;
    }

    public function findByPostId(int $postId)
    {
        $stm = 'posts?select=*&id=eq.' . $postId;
        $post = $this->conn->query($stm);
        if ($post && count($post) > 0) {
            $post = $post[0];
        } else {
            $post = [];
        }
        return $post;
    }

    public function save(array $post): bool
    {
        $stm = 'posts';
        $result = $this->conn->query(
            $stm,
            array(
                'title' => $post['title'],
                'email' => $post['email'],
                'message' => $post['text'],
                'user_id' => $post['user_id']
            )
        );
        return true;
    }

    public function update(array $post, int $postid): bool
    {
        $stm = 'posts?id=eq.'.$postid;
        $result = $this->conn->query(
            $stm,
            array(
                'title' => $post['title'],
                'email' => $post['email'],
                'message' => $post['text']
            ),
            'PATCH'
        );
        return true;
    }

    public function delete(int $postid): int
    {
        $stm = 'posts?id=eq.'.$postid;
        $result = $this->conn->query(
            $stm,
            array(),
            'DELETE'
        );
        return true;
    }
}
