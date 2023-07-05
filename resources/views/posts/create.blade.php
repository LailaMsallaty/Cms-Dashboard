@extends('layouts.app')

@section('stylesheet')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="card card-default">
<div class="card-header">
    {{  isset($post)? 'Update Post' : 'Add A New Post' }}</div>
    <div class="card-body">

    <form action="{{isset($post)? route('posts.update',$post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($post))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="post title">Title :</label>
            <input type="text" value="{{isset($post)? $post->title : ''}}" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Add A new post">
            </div>

                    @if($errors->has('title'))
                                
                    <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                
                    @endif

            <div class="form-group">
                <label for="post description">Description :</label>
                <textarea name="description"  rows="2" class="form-control @error('description') is-invalid @enderror" placeholder="Add A Description" >{{isset($post)? $post->description : ''}}</textarea>
            </div>

                    @if($errors->has('description'))
                                
                    <div class="alert alert-danger">{{ $errors->first('description') }}</div>
                
                    @endif

            <div class="form-group">
                <label for="post content">Content :</label>
              {{-- <textarea name="content" rows="2" class="form-control  @error('content') is-invalid @enderror" placeholder="Add A Content" ></textarea> --}}
                <input  type="hidden" value="{{isset($post)? $post->content : ''}}"  id="x" name="content">
                <trix-editor input="x"></trix-editor>
            </div>
            @if($errors->has('content'))
                        
            <div class="alert alert-danger">{{ $errors->first('content') }}</div>
          
            @endif
             @if (isset($post))
             <div class="form-group">
                <img src="{{asset('storage/' .$post->image)}}" alt="" style="width:100%">
              </div>
             @endif
         
            <div class="form-group">
                <label for="post image">Image :</label>
                <input type="file" name="image" class="form-control">
            </div>
    
            <div class="form-group">
                <label for="SelectCategory">Select a Category</label>
                <select name="categoryID" class="form-control" id="SelectCategory">
        
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                        
                </select>
              </div>

            @if ($tags->count()>0)
                    <div class="form-group">
                        <label for="SelectTag">Select a Tag</label>
                        <select name="tags[]" class="form-control tags" id="SelectTag" multiple>
                
                                @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}"
                                        @if ($post->hasTag($tag->id))
                                            selected
                                        @endif
                                        >{{$tag->name}}</option>
                                @endforeach
                                
                        </select>
                    </div>
            @endif

            <div class="form-group">
              <button type="submit" class="btn btn-success"> {{isset($post)? 'Update' : 'Add' }}</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix-core.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
   
    <script>
        // In your Javascript (external .js resource or <script> tag)
            $(document).ready(function() {
                $('.tags').select2();
            });
    </script>
@endsection