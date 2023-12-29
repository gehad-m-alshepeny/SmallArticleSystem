@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4>{{ $article->title }}</h4>
                    <p>
                        {{ $article->content }}
                    </p>
                    <hr />
                    @if(auth()->user()->role_id == ADMIN && $article->status=='pending')
                    <form method="post" action="{{ route('articles.approve') }}">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="article_id" value="{{ $article->id }}" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" >Approve </button>
                        </div>
                    </form>
                    @endif
                    @if($article->status=='approved')
                    <h6 style="color:green; font-weight:bold;">Comments</h6>
  
                    <hr />
                    @if($article->comments->count() > 0)
                    @foreach($article->comments as $comment)
                    <div class="display-comment" >
                        <strong>{{ $comment->createdBy->name }}</strong>
                        <p>{{ $comment->content }}</p>
                    </div>
                    <hr />
                    @endforeach
                    @else
                    <p> No comments ..</p>
                    @endif
   
                    <h4>Add comment</h4>
                    <form method="post" action="{{ route('comments.store') }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="content"></textarea>
                            <input type="hidden" name="article_id" value="{{ $article->id }}" />
                        </div>
                        @if($errors->has('content'))
                                <div class="alert alert-danger">{{ $errors->first('content') }}</div>
                            @endif
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Add Comment" />
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection