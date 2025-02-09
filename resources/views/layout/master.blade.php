<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon">
    <!--  Font Awesome for Bootstrap fonts and icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">
    <!-- Material Design for Bootstrap CSS -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <title>Hyper-Coder</title>
    <style></style>
  </head>
  <body>
    <!-- Start Nav -->
    <nav class="navbar navbar-expand-lg">
      <a class="navbar-brand text-warning" href="#">Blogging!</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Articles</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> User </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @if (Auth::check())
              <a class="dropdown-item" href="#">Welcome {{Auth::user()->name}}</a>
              <a href="{{route('logout')}}" class="dropdown-item">Logout</a>
              @else
              <a class="dropdown-item" href="{{route('showlogin')}}">Login</a>
              <a class="dropdown-item" href="{{route('register')}}">Register</a>
              @endif
            </div>
          </li>
          <li class="nav-item ml-5">
            <a class="nav-link btn btn-sm  btn-warning" href="{{route('createArticle')}}">
              <i class="fas fa-plus"></i> Create Article </a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="get">
          <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <!-- Start Header -->
    <div class="jumbotron jumbotron-fluid header">
      <div class="container">
        <h1 class="text-white">Coder Online Course</h1>
        <h1 class="display-4 text-white">Welcome Com From Advance PHP Online Class</h1>
        <p class="lead text-white">Hello Now We publish this course free.</p>
        <br>
        @if (!Auth::check())
        <a href="{{route('register')}}" class="btn btn-warning">Create Account</a>
        <a href="{{route('showlogin')}}" class="btn btn-outline-success">Login</a>
        @endif
      </div>
    </div>
    <!-- Content -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 pr-3 pl-3">
          <!-- Category List -->
          <div class="card card-dark">
            <div class="card-header">
              <h4>All Category</h4>
            </div>
            <div class="card-body">
              <ul class="list-group">
              @foreach ($category as $c)
              <a href="{{url('category/'.$c->slug)}}">
              <li class="list-group-item d-flex justify-content-between align-items-center"> 
                  {{$c->name}}
                  <span class="badge badge-primary badge-pill">{{$c->article_count}}</span>
                </li>
              </a>
              @endforeach
              </ul>
            </div>
          </div>
          <hr>
          <!-- Language List -->
          <div class="card card-dark">
            <div class="card-header">
              <h4>All Languages</h4>
            </div>
            <div class="card-body">
              <ul class="list-group">
                @foreach ($language as $l)
                <a href="{{url('language/'.$l->slug)}}">
                <li class="list-group-item d-flex justify-content-between align-items-center"> 
                  {{$l->name}}
                  <span class="badge badge-primary badge-pill">{{$l->article_count}}</span>
                </li>
                </a>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <!-- Content -->
        <div class="col-md-8">
          @yield('content')
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
      $(document).ready(function() {
        $('body').bootstrapMaterialDesign();
      });
    </script>
    @include('layout.message')
    @yield('script')
  </body>
</html>