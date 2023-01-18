<html>
    <head>
        <title>My App</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/style.css" />
    </head>
    <body>
    <nav class="navbar navbar-dark navbar-expand-lg bg-body-tertiary mb-5">
        <div class="container">
            <a class="navbar-brand" href="/">Freeblog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" aria-current="page" href="/">Home</a>
                <a class="nav-link" href="/posts">Posts</a>
                <a class="nav-link" href="/posts/create">New post</a>
                <!-- <a class="nav-link disabled">Disabled</a> -->
            </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1>My App</h1>
        <p>My App is running.</p>
        <?= $this->content ?>
    </div>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>