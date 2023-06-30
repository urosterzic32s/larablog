@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="mb-4 p-5 bg-warning text-white rounded">
        <h1>Admin Dashboard</h1>
    </div>

    <div class="col-md-12">
            <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-margin-right white-text">Create Blog</a>

            <a href="{{ route('blogs.trash') }}" class="btn btn-danger btn-margin-right white-text">Trashed Blogs</a>

            <a href="{{ route('categories.create') }}" class="btn btn-success btn-margin-right white-text">Create Category</a>
    </div>
</div>

@endsection