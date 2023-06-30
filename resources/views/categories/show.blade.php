@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="mb-4 p-5 bg-warning text-white rounded">
            <h1>{{ $category->name }}</h1>
            <div class="btn-group">
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success btn-margin-right">Edit</a>
                {{-- <a href="{{ route('categories.destroy', $category->id) }}" class="btn btn-danger btn-sm btn-margin-right">Delete</a> --}}
        
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
    
            </div>

        </div>
        
            <div class="col-md-12">
                @foreach ($category->blog as $blog)
                    <h3><a href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a></h3>
                @endforeach
            </div>

    </div>

@endsection