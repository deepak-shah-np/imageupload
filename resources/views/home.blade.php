@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Logged In user detail</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <ul class="list-group">
                            <li class="list-group-item">Name: {{$user->name}}</li>
                            <li class="list-group-item">Email: {{$user->email}}</li>

                            @if(!empty($user->photo))
                            <li class="list-group-item">Photo :

                                <img class="card-img-top" src="{{url('uploads/'.$user->photo)}}">
                                <a class="btn btn-primary" href="{{Route('image_delete',["id"=>$user->id])}}"> Delete this photo</a>
                            </li>
                            @endif
                        </ul>


                    <div>
                        <form method="post" action="{{Route('image_store',["id"=>$user->id])}}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Upload photo</label>
                                <input type="file" name="photo" class="form-control">
                            </div>
                            <input type="submit" value="save" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
