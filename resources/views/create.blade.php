@extends('layout.master')

@section('content')
<div class="card card-dark">
    <div class="card-header">
        <h3>Create New Article</h3>
    </div>
    <div class="card-body">
        <form action="{{route('postArticle')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group">
                <label for="" class="text-white">Enter Title</label>
                <input type="name" name="title" class="form-control" placeholder="enter Title" />
            </div>
            <div class="form-group">
                <label for="" class="text-white">Choose Category</label>
                <select name="category_id" id="" class="form-control">
                    @foreach ($cat as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                    
                </select>
            </div>
            <div class="form-check form-check-inline">
                @foreach ($lang as $l)
                <span class="mr-2">
                    <input class="form-check-input" type="checkbox" name="language[]" value="{{$l->id}}" />
                    <label class="form-check-label" for="inlineCheckbox1">{{$l->name}}</label>
                </span>
                @endforeach
                
            </div>
            <br />
            <br />
            <div class="form-group">
                <label for="">Choose Image</label>
                <input type="file" name="image" class="form-control" name="image" />
            </div>
            <div class="form-group">
                <label for="" class="text-white">Enter Articles</label>
                <textarea name="article" class="form-control" id="" cols="30" rows="10"></textarea>
            </div>
            <input type="submit" value="Create" class="btn btn-outline-warning" />
        </form>
    </div>
</div>

@endsection