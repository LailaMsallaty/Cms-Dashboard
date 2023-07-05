@extends('layouts.app')


@section('content')
<div class="card card-default">
<div class="card-header">{{ isset($tag) ? "Update Tag" : "Add A New Tag"}}</div>
    <div class="card-body">

    <form action ='{{isset($tag) ? route('tags.update',$tag->id) : route('tags.store')}}' method="POST">
            @csrf
                @if(isset($tag))
                     @method('PUT')
                @endif
            <div class="form-group">
                <label for="tag">Tag Name:</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Add A new Tag" value="{{ isset($tag) ? $tag->name : ""}}">
            </div>

            @if($errors->has('name'))
                        
                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
              
            @endif

            <div class="form-group">
              <button class="btn btn-success">{{ isset($tag) ? "Update" : "Add"}}</button>
            </div>
        </form>
    </div>
</div>

@endsection