<div class="row d-flex justify=content-center g-3">
    <article>
        <?php
            echo '<h1>' . $post->title . '</h1>';
            echo '<p>' . $post->message . '</p>';
        ?>
    </article>
    <div class="row d-flex justify=content-center g-3">
        <div class="col-md-6">
            <form action="/posts/<?= $post->id ?>/edit" method="GET">
                <button class="btn btn-success"> EDIT </button>
            </form>            
        </div>
        <div class="col-md-6">
            <form action="/posts/<?= $post->id ?>/delete" method="POST">
                <button class="btn btn-danger"> DELETE </button>
            </form>    
        </div>
    </div>
    <div class="row d-flex justify=content-center g-3">
        <form action="/posts/<?= $post->id ?>/comments" method="POST">
            <div class="form-group mb-3">
                <label for="exampleInputEmail1">Email address</label>
                <input required type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group mb-3">
                <label for="exampleFormControlTextarea1">Post content</label>
                <textarea required class="form-control" name="text" id="text" rows="3" placeholder="..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><small>Add comment</small></button>
        </form>
    </div>
    <div class="row d-flex justify=content-center g-3">
        <?php 
            foreach ($comments as $comment):
                $time = time_elapsed_string(strtotime($comment->created_at));
                // $commentdate = date('Y-m-d @ h:i',$time);
        ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= $comment->comment ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= $comment->email ?></h6>
                <p class="card-text"><?= $time ?></p>
            </div>
        </div>
        <?php
            endforeach;
        ?>
    </div>
</div>