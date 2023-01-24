<div class="row d-flex justify-content-center g-3">
    <div class="col-md-9">
        <h1>Sign in</h1>
        <form action="/auth/login" method="POST">
            <input type="hidden" name="_csrf" value="<?= $token ?>">
            <div class="form-group mb-3">
                <label for="exampleInputEmail1">Email address</label>
                <input required type="email" value="" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input required type="password" value="" class="form-control" name="password" id="password" aria-describedby="passwordHelp" placeholder="******">
            </div>
            <button type="submit" class="btn btn-primary">LOGIN</button>
        </form>
    </div>
</div>