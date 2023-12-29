@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Create Article</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('articles.store') }}">
                        <div class="form-group">
                            @csrf
                            <label class="label">Title: </label>
                            <input type="text" name="title" class="form-control" />
                            @if($errors->has('title'))
                            <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="label">Content: </label>
                            <textarea name="content" rows="4" cols="30" class="form-control"></textarea>
                        </div>
                            @if($errors->has('content'))
                                <div class="alert alert-danger">{{ $errors->first('content') }}</div>
                            @endif
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-success" />
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection