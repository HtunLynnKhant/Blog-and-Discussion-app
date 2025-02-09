@extends('layout.master')
<style>
    #like{
        cursor: pointer;
    }
</style>
@section('content')
<div class="col-md-8">
    <div class="card card-dark">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-dark">
                        <div class="card-body">
                            <div class="row">
                                <!-- icons -->
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            <i class="fas fa-heart text-warning" id="like"> </i>
                                            <small class="text-muted" id="like_count">{{$article->like_count}}</small>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <i class="far fa-comment text-dark"></i>
                                            <small class="text-muted">{{$article->comment_count}}</small>
                                        </div>
                                    </div>
                                </div>
                                <!-- Icons -->

                                <!-- Category -->
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="" class="badge badge-primary">{{$article->category->name}}</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Category -->

                                <!-- Category -->
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @foreach ($article->language as $l)
                                            <a href="{{url('language/'.$l->slug)}}" class="badge badge-success">{{$l->name}}</a>
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- Category -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div class="col-md-12">
                <h3>{{$article->title}}</h3>
                <p>
                    {{$article->description}}
                </p>
            </div>

            <!-- Comments -->
            <div class="card card-dark">
                <div class="card-header">
                    <h4>Comments</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <textarea name="comment" id="comment" class="form-control" id="" cols="30" rows="2">

                            </textarea>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <input id="create_comment" type="submit" class="btn btn-danger" value="Create">
                        </div>
                    </div>

                    <div id="comment_list">
                        <!-- Loop Comment -->
                        @foreach ($article->comment as $c)
                        <div class="card-dark mt-1">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{asset($c->user->image)}}" style="width: 30px;height:30px; border-radius: 50%;" alt="" />
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center">
                                        {{$c->user->name}}
                                    </div>
                                </div>
                                <hr />
                                <p>
                                    {{$c->comment}}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    const like = document.querySelector('#like');
    const like_count = document.querySelector('#like_count');

    like.addEventListener('click', () => {
        axios.get('/article/like/' + {{$article->id}})
            .then(res => {
                toastr.success('Like success');
                like_count.innerHTML = res.data.data;
            })
            .catch(err => {
                if (err.response && err.response.status === 400) {
                    toastr.error(err.response.data.error);
                } else {
                    toastr.error('An error occurred while liking the article.');
                }
            });
    });

    const comment =document.getElementById('comment');
    const comment_list =document.getElementById('comment_list');
    const create_comment =document.getElementById('create_comment');
    create_comment.addEventListener('click', () => {
        const formData = new FormData();
        formData.append('comment',comment.value);
        formData.append('article_id',"{{$article->id}}");
        axios.post('/comment/create', formData)
        .then(function(res){
            toastr.success('Created Comment')
            comment_list.innerHTML = res.data.data;
        })
    });

</script>
@endsection