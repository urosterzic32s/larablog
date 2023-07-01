@extends('layouts.app')

@include('partials.meta_dynamic')

@section('content')


    <div class="container-fluid">
        <article>
            <div class="mb-4 p-5 bg-warning text-white rounded">

                <div class="col-sm-12">
                    @if($blog->featured_image)
                        <img src="/larablog/public/images/featured_image/{{ $blog->featured_image ?? '' }}" class="img-responsive featured_image">
                    @endif
                </div>

                <div class="col-md-12">
                    <h1>{{ $blog->title }}</h1>
                </div>
                <div class="col-md-12">

                    <div class="btn-group">

                        <a href="{{ route('blogs.edit', ['id' => $blog->id]) }}" class="btn btn-primary btn-xs pull-left btn-margin-right">Edit
                        </a>
                        
                        <form action="{{ route('blogs.delete', $blog->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-xs pull-left">Delete</button>
                        </form>
                        
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                {!! $blog->body !!}
                @if ($blog->user)
                Author: <a href="{{ route('users.show', $blog->user) }}">{{ $blog->user->name }}</a> | Posted: {{ $blog->created_at->diffForHumans() }}
                @endif
                <hr>
                <strong>Categories:</strong>
                @foreach ($blog->category as $category)
                    <a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>
                @endforeach
            </div>
        </article>
    </div>
@endsection