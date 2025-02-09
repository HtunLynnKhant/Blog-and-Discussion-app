@extends('layout.master')
@section('content')
  <div class="card card-dark">
    <div class="card-header bg-warning">
      <h3>Login</h3>
    </div>
    <div class="card-body">
      <form action="{{route('postlogin')}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="form-group">
          <label for="" class="text-white">Enter Email</label>
          <input type="email" name="email" class="form-control" placeholder="enter username">
        </div>
        <div class="form-group">
          <label for="" class="text-white">Enter Password</label>
          <input type="password" name="password" class="form-control" placeholder="enter password">
        </div>
        <input type="submit" value="Login" class="btn  btn-outline-warning">
      </form>
    </div>
  </div>
@endsection