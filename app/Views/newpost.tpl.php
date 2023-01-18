<div class="row d-flex justify-content-center g-3">
    <div class="col-md-9">
        <h1>Create new post</h1>
        <form action="/posts/save" method="POST">
            <div class="form-group mb-3">
                <label for="exampleInputEmail1">Email address</label>
                <input required type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group mb-3">
                <label for="exampleInputEmail1">Title</label>
                <input required type="text" class="form-control" name="title" id="title" aria-describedby="titleHelp" placeholder="Enter title">
            </div>
            <div class="form-group mb-3">
                <label for="exampleFormControlTextarea1">Post content</label>
                <textarea required class="form-control" name="text" id="text" rows="3" placeholder="..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>