@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="jumbotron">
        <h1>Edit Category</h1>
    </div>

    <div class="col-md-12">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="name">Name of category</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}">
            </div>

            <button class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>
</div>

@endsection