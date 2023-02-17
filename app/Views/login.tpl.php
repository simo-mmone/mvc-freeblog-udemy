<div class="row d-flex justify-content-center g-3">
    <div class="col-md-9">
        <h1><?= $signup ? "Sign up" : "Sign in" ?></h1>
        <?php if (array_key_exists('message', $_SESSION)): ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['message'] ?>
            </div>
        <?php endif; ?>
        <form id="login-form" action="/auth/<?= $signup ? "signup" : "login" ?>" method="POST">
            <input type="hidden" name="_csrf" value="<?= $token ?>">
            <?php if ($signup): ?>
                <div class="form-group mb-3">
                    <label for="exampleInputEmail1">Username</label>
                    <input required type="text" value="" class="form-control" name="name" id="name" aria-describedby="nameHelp" placeholder="Enter name">
                </div>
            <?php endif; ?>
            <div class="form-group mb-3">
                <label for="exampleInputEmail1">Email address</label>
                <input required type="email" value="" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input required type="password" value="" class="form-control" name="password" id="password" aria-describedby="passwordHelp" placeholder="******">
            </div>
            <button type="submit" class="btn btn-primary">LOGIN</button>

            <?php if (!$signup): ?>
                <script>
                    //wait for document to be ready
                    document.addEventListener("DOMContentLoaded", function() {
                        //get the form
                        var form = document.getElementById('login-form');
                        //add event listener to the form
                        form.addEventListener('submit', function(e) {
                            //prevent the form from submitting
                            e.preventDefault();
                            //get the form data
                            var formData = new FormData(form);
                            //create a new ajax request
                            var xhr = new XMLHttpRequest();
                            //open the request
                            xhr.open('POST', '/auth/login');
                            //set the request header
                            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                            //set the csrf token
                            xhr.setRequestHeader('X-CSRF-Token', '<?= $token ?>');
                            //set the response type
                            xhr.responseType = 'json';
                            //add event listener for the request
                            xhr.addEventListener('load', function() {
                                //check if the request was successful
                                if (xhr.status === 200) {
                                    console.log(xhr.response);
                                    const response = xhr.response;
                                    if (response.success) {
                                        //redirect to the home page
                                        window.location.href = '/';
                                    } else {
                                        //display the error message
                                        alert(response.message);
                                    }
                                } else {
                                    //display the error message
                                    alert(xhr.response.message);
                                }
                            });
                            xhr.send(formData);
                        });
                    });
                </script>
            <?php endif; ?>
        </form>
    </div>
</div>