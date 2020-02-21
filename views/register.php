<div class="container mt-5">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 col-12 mx-auto">
            {{$message}}
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Register form
                </div>
                <div class="card-body">
                    <form method="POST" action="/register">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Username</label>
                            <input type="text"  required class="form-control" id="exampleInputUsername1" name="username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email"  required name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password"  required class="form-control" id="exampleInputPassword1" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                        <a href="/login">Already have an account?</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
