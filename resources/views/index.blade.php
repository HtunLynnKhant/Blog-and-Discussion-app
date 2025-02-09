@extends('layout.master')
@section('content')
<div class="card card-dark">
            <div class="card-body">
              <a href="{{$articles->previousPageUrl()}}" class="btn btn-danger">Prev Posts</a>
              <a href="{{$articles->nextPageUrl()}}" class="btn btn-danger float-right">Next Posts</a>
            </div>
          </div>
          <div class="card card-dark">
            <div class="card-body">
              <div class="row">
                <!-- Loop this -->
                @if(isset($error_message))
                    <div class="ml-4">{{ $error_message }}</div>
                @endif
                 @foreach ($articles as $a)
                <div class="col-md-4 mt-2">
                  <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{asset($a->image)}}" style="height:200px;" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="text-dark">{{$a->title}}</h5>
                    </div>
                    <div class="card-footer">
                      <div class="row">
                        <div class="col-md-4 text-center">
                          <i class="fas fa-heart text-warning"></i>
                          <small class="text-muted">{{$a->like_count}}</small>
                        </div>
                        <div class="col-md-4 text-center">
                          <i class="far fa-comment text-dark"></i>
                          <small class="text-muted">{{$a->comment_count}}</small>
                        </div>
                        <div class="col-md-4 text-center">
                          <a href="{{url('/article/'.$a->slug)}}" class="badge badge-warning p-1">View</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
@endsection