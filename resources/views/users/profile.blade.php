@extends('layouts.app')


@section('content')
<div class="card card-default">
<div class="card-header">Profile</div>
    <div class="card-body">

    <form action ="{{route('users.update',$user->id)}}" enctype="multipart/form-data" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Name :</label>
                <input type="text" name="name" class="form-control"  value="{{$user->name}}">
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="text" name="email" class="form-control"  value="{{$user->email}}">
            </div>

            <div class="form-group">
                <label for="about">About :</label>
                <textarea name="about" placeholder="Tell us about you"  rows="2" class="form-control">{{$profile->about}}</textarea>
            </div>

            <div class="form-group">
                <label for="facebook">Facebook :</label>
                <input type="text" name="facebook" class="form-control"  value="{{$profile->facebook}}">
            </div>

            <div class="form-group">
                <label for="twitter">Twitter :</label>
                <input type="text" name="twitter" class="form-control" value="{{$profile->twitter}}">
            </div>

            <div class="form-group">
                <label for="picture">Picture :</label><br>
            <img src="
                  {{$user->hasPicture() ? asset('storage/'.$user->getPicture()) : $user->getGravatar()}}
            " alt=""  width="50%" height="50%">
                <input type="file" name="picture" class="mt-2 form-control">
            </div>

            <div class="form-group">
              <button class="btn btn-success">Update Profile</button>
            </div>
        </form>
    </div>
</div>

@endsection