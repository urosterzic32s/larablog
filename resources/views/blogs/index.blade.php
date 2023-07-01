@extends('layouts.app')

@include('partials.meta_static')

@section('content')

<div class="container">
    @if (Session::has('blog_created_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('blog_created_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    @foreach ($blogs as $blog)
    <div class="col-md-8 offset-md-2 text-center">
        <h2><a href="{{ route('blogs.show', [$blog->slug]) }}">{{ $blog->title }}</a></h2>

        <div class="col-sm-12">
            @if($blog->featured_image) 
                <img src="/larablog/public/images/featured_image/{{ $blog->featured_image ?? '' }}" class="img-responsive featured_image" style="width:300px;height:auto;">
            @endif
        </div>

        <div class="lead">{!! Str::limit($blog->body, 200, '...') !!}</div>
        
        @if ($blog->user)
        Author: <a href="{{ route("users.show", $blog->user->name) }}">{{ $blog->user->name }}</a> | Posted: {{ $blog->created_at->diffForHumans() }}
        @endif
    </div>
    <hr>
    @endforeach
</div>
    
@endsection