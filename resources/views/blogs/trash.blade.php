@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="mb-4 p-5 bg-warning text-white rounded">
            <h1>Trashed Blogs</h1>
        </div>
    </div>

    <div class="col-md-12">
        @foreach ($trashedBlogs as $blog)
            <h2>{{ $blog->title }}</h2>
            <p>{{ $blog->body }}</p>
        
        <div class="btn-group">

            <form action="{{ route('blogs.restore', $blog->id) }}" method="GET">
                @csrf
                <button type="submit" class="btn btn-success btn-xs pull-left btn-margin-right">Restore</button>
            </form>
            
            {{-- Permanent delete --}}
            <form action="{{ route('blogs.permanentDelete', $blog->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-xs pull-left btn-margin-right">Permanent delete</button>
            </form>
            
        </div>
        @endforeach
    </div>
@endsection
