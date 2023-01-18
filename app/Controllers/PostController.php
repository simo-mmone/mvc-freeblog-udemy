<?php
namespace App\Controllers;
use App\Models\Post;
use App\Models\Comment;
use App\DB\DBPDO;

class PostController extends BaseController
{
    protected Post $post;

    public function __construct(
        protected DBPDO $conn
    ) {
        parent::__construct($conn);
        $this->post = new Post($this->conn);
    }    

    public function show( $postid ): void
    {
        $post = $this->post->findByPostId($postid);
        $comment = new Comment($this->conn);
        $comments = $comment->all($postid);
        $this->content = view('post', ['post' => $post, 'comments' => $comments], $this->tplDir);
    }

    public function edit( $postid ): void
    {
        $post = $this->post->findByPostId($postid);
        $this->content = view('editpost', ['post' => $post], $this->tplDir);
    }

    public function create(): void
    {
        $this->content = view('newpost');
    }

    public function save(?int $postid = null): void
    {
        $post = [
            'title' => $_POST['title'] ?? '',
            'email' => $_POST['email'] ?? '',
            'text' => $_POST['text'] ?? ''
        ];

        if(!$postid){
            $this->post->save($post);
        } else{
            $this->post->update($post, $postid);
        }

        header('Location: /');
    }

    public function saveComment(int $postid): void
    {
        $comment = [
            'email' => $_POST['email'] ?? '',
            'text' => $_POST['text'] ?? ''
        ];

        $commentObj = new Comment($this->conn);
        $commentObj->save($comment, $postid);

        header('Location: /posts/'.$postid);
    }

    public function delete(int $postid): void
    {        
        $this->post->delete($postid);

        header('Location: /');
    }

    public function getPosts(): void
    {
        $posts = $this->post->all();
        $this->content = view('posts', ['posts' => $posts], $this->tplDir);
    }

    public function display(): void
    {
        require $this->layout;
    }
}