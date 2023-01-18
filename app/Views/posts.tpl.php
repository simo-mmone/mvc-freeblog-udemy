<article>
    <!-- <h1>Il mio post</h1> -->

    <div class="list-group">
        <?php
            foreach ($posts as $post):
                // print_r($post);
            ?>

        <a href="/posts/<?= $post->id ?>" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><?= $post->title ?></h5>
                <small class="text-muted"><?= time_elapsed_string(strtotime($post->created_at)) ?></small>
            </div>
            <p class="mb-1"><?= $post->message ?></p>
            <small class="text-muted"><?= $post->email ?></small>
        </a>
        <?php
            endforeach;
        ?>
    </div>
</article>