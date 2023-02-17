<?php
namespace App\Controllers;
use App\Models\Post;
use App\Models\Comment;
use App\DB\DbPdo;

class PostController extends BaseController
{
    protected Post $post;

    public function __construct(
        protected DbPdo $conn
    ) {
        parent::__construct($conn);
        $this->post = new Post($this->conn);
    }    

    private function redirectInNotLoggedIn()
    {
        if(!isUserLoggedIn())
            $this->redirect('/auth/login');
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
        $this->redirectInNotLoggedIn();
        $post = $this->post->findByPostId($postid);
        $this->content = view('editpost', ['post' => $post], $this->tplDir);
    }

    public function create(): void
    {
        $this->redirectInNotLoggedIn();
        $this->content = view('newpost');
    }

    public function save(?int $postid = null): void
    {
        $this->redirectInNotLoggedIn();
        $post = [
            'title' => $_POST['title'] ?? '',
            'email' => $_SESSION['user']->email ?? '',
            'text' => $_POST['text'] ?? '',
            'user_id' => $_SESSION['user']->id ?? ''
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
        $this->redirectInNotLoggedIn();
        $comment = [
            'email' => $_SESSION['user']->email ?? '',
            'text' => $_POST['text'] ?? ''
        ];

        $commentObj = new Comment($this->conn);
        $commentObj->save($comment, $postid);

        header('Location: /posts/'.$postid);
    }

    public function delete(int $postid): void
    {        
        $this->redirectInNotLoggedIn();
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