@extends('layouts.app')


@section('content')

   <div class="card card-default">
    <div class="card-header">All Users</div>
@if ($users->count()>0)
     <div class="card-body"> 
      <table class="table">
         <thead>

            <tr>
               <th>Image</th>
               <th>UsreName</th>
               <th>Permission</th>
            </tr>
         </thead>
   
         <tbody>
            @foreach($users as $user)
               <tr>
                {{-- <td><img src="{{asset('storage/'.$user->image)}}" alt="" width="100px" height="50px"></td>--}}

               <td><img src="{{$user->hasPicture() ? asset('storage/'.$user->getPicture()) : $user->getGravatar()}}" alt="" style="border-radius:50%" width="60px" height="60px"></td> 
                  <td>{{$user->name}}</td>
                  <td>
                      @if (!$user->isAdmin())

                            <form action="{{route('users.make-admin',$user->id)}}" method="POST">
                              @csrf
                              <button class="btn btn-success" type="submit">Make Admin</button>
                            </form>
                      @else 
                        {{$user->role}}   
                      @endif
                  </td>

               </tr>
            @endforeach
            </tbody>
      </table>
  </div>
         
@else
<div class="card-body">
    <h1 class="text-center"> No Users Yet.</h1>
</div>
@endif
   </div>
@endsection