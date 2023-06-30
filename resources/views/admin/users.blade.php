@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="jumbotron">
        <h1>Manage Users</h1>
    </div>

    <div class="col-md-12">
        <div class="row">
            @foreach ($users as $user)
            <div class="col-md-4">

                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="form-group">
                        <input value="{{ $user->name }}" class="form-control" disabled>
                    </div>
                    
                    <div class="form-group">
                        <select name="role_id" class="form-control">
                            <option selected>Current role: {{ $user->role->name }}</option>
                            <option value="1">admin</option>
                            <option value="2">author</option>
                            <option value="3">subscriber</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <input class="form-control" value="{{ $user->email }}" disabled>
                    </div>
                    
                    <div class="form-group">
                        <input class="form-control" value="{{ $user->created_at->diffForHumans() }}" disabled> 
                    </div>
                    
                    <button class="btn btn-primary btn-xs pull-left col-md-12">Update</button>
                </form>
                
                <form action="{{ route('users.destroy', $user) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    
                    <button type="submit" class="btn btn-danger btn-xs pull-left col-md-12">Delete</button>
                </form>
            </div>
                @endforeach
            </div>
        </div>
        
    </div>

@endsection