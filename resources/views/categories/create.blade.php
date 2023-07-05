@extends('layouts.app')


@section('content')
<div class="card card-default">
<div class="card-header">{{ isset($category) ? "Update Category" : "Add A New Category"}}</div>
    <div class="card-body">

    <form action ='{{isset($category) ? route('categories.update',$category->id) : route('categories.store')}}' method="POST">
            @csrf
                @if(isset($category))
                     @method('PUT')
                @endif
            <div class="form-group">
                <label for="category">Category Name:</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Add A new Category" value="{{ isset($category) ? $category->name : ""}}">
            </div>

            @if($errors->has('name'))
                        
                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
              
            @endif

            <div class="form-group">
              <button class="btn btn-success">{{ isset($category) ? "Update" : "Add"}}</button>
            </div>
        </form>
    </div>
</div>

@endsection