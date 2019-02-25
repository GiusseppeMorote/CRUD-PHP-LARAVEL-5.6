@extends('layouts.app') 
@section('title','Trainer Edit') 
@section('content')


<form method="POST" action="/trainers/{{$trainer->slug}}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <img style="height: 200px; width: 200px;background-color: #EFEFEF; margin: 20px" src="/images/{{$trainer->avatar}}" class="card-img-top  rounded-circle mx-auto d-block">
    <div class="form-group">
        <label for="">Nombre</label>
        <input type="text" name="name" value="{{$trainer->name}}" class="form-control">
    </div>
        
    <div class="form-group">
        <label for="">Avatar</label>
        <input type="file" name="avatar">
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
@endsection