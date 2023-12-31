@extends('layouts.app')


@section('content')
<div class="clearfix"><a href="{{route('posts.create')}}" class="btn btn-success float-right" style="margin-bottom:10px">Add Post</a></div>
   <div class="card card-default">
    <div class="card-header">All posts</div>
     @if ($posts->count()>0)
     <div class="card-body"> 
      <table class="table">
         <thead>

            <tr>
               <th>Image</th>
               <th>Title</th>
               <th>Actions</th>
            </tr>
         </thead>
   
         <tbody>
            @foreach($posts as $post)
               <tr>
                  <td><img src="{{asset('storage/'.$post->image)}}" alt="" width="100px" height="50px"></td>
                  <td>{{$post->title}}</td>
               <td>
                  <form class="float-right ml-2" action="{{ route('posts.destroy',$post->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                      {{ $post->trashed() ? 'Delete' : 'Trash'}}
                    </button>
                  </form>
                 @if (!$post->trashed())
                   <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary float-right btn-sm">Edit</a></td>
                   @else
                   <a href="{{route('trashed.restore',$post->id)}}" class="btn btn-primary float-right btn-sm">Restore</a></td>
                 @endif
               </tr>
            @endforeach
            </tbody>
      </table>
  </div>
         
     @else
      <div class="card-body">
         <h1 class="text-center"> No Posts Yet.</h1>
      </div>
     @endif
   </div>
@endsection