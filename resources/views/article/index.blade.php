@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h4>Articles</h4>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
           @endif
           @can('create', App\Models\Article::class)
            <a class="btn btn-success" style="float: right" href="{{ route('articles.create') }}"> Create New Article</a>
          @endcan

          <form method="GET" action="{{ route('articles.index') }}">
             <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="titlesearch" value="{{ request()->get('titlesearch')}}" class="form-control" placeholder="Enter Title For Search" value="{{ old('titlesearch') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <button class="btn btn-success">Search</button>
                        </div>
                    </div>
                </div>
            </form>

           @if($articles->count() > 0)
            <table class="table table-bordered table-hover">
                <thead>
                    <th >Title</th>
                    <th >Content</th>
                    <th >Posted By</th>
                    <th >Status</th>
                    <th width="30%">Action</th>
                </thead>
                <tbody>
                @foreach($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->content }}</td>
                    <td>{{ $article->createdBy->name }}</td>
                    <td>{{ $article->status }}</td> 
                    <td>
                    <form method="post" action="{{ route('articles.destroy',$article->id) }}">
                        @csrf
                        @method('PUT')
                        <a class="btn btn-info" href="{{ route('articles.show',$article->id) }}">Show</a>
                        @can('update', $article)
                        <a class="btn btn-primary" href="{{ route('articles.edit',$article->id) }}">Edit</a>
                        @endcan
                        @can('delete', $article)
                         <button type="submit" class="btn btn-danger" >Delete </button>
                        @endcan
                    </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
   
            </table>
        </div>
    </div>
    @else
    <p> No Articles ..</p>
    @endif
</div>

@endsection