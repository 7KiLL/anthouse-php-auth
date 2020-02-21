<div class="container mt-5">
  <div class="row">
    <div class="col-lg-8 col-lg-offset-2 col-12 mx-auto">
      <h1 class="display-1">Hello, {{$name}}!</h1>
      <div>
        <form action="/logout" method="get">
          <button class="btn btn-danger" type="submit">Logout</button>
        </form>
      </div>
    </div>
  </div>
</div>
