<html>
    <head>
        <title>My App</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/style.css" />
    </head>
    <body>
    <nav class="navbar navbar-dark bg-dark sticky-top navbar-expand-lg bg-body-tertiary mb-5" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="/">Freeblog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="/">Home</a>
                    <a class="nav-link" href="/posts">Posts</a>
                    <?php if (isUserLoggedIn()) : ?>
                    <a class="nav-link" href="/posts/create">New post</a>
                    <?php endif; ?>
                    <!-- <a class="nav-link disabled">Disabled</a> -->
                </div>
            </div>
            <div class="navbar-nav">
                <?php
                    if (!isUserLoggedIn()):
                ?>
                <a class="nav-link" href="/auth/login">Login</a>
                <a class="nav-link" href="/auth/signup">Signup</a>
                <?php
                    else:
                ?>
                <!-- Nome utente -->
                <div class="nav-link disabled"><?= getUserName() ?></div>
                <a class="nav-link" href="/auth/logout">Logout</a>
                <?php
                    endif;
                ?>
            </div>
        </div>
        
    </nav>
    <div class="container">
        <h1>My App</h1>
        <p>My App is running.</p>
        <?= $this->content ?>
    </div>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>