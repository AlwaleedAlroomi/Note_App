@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="jumbotron">
                    <h1 class="display-4">Hello, {{$user->name}}!</h1>
                    <p class="lead"><strong>All Notes.</strong></p>
                    <a class="btn btn-success" href="{{route('note.create')}}">Add Note &nbsp;<i class="fas fa-plus"></i></a>&nbsp;
                    <a class="btn btn-danger" href="{{route('notes.trashed')}}">Deleted Notes &nbsp;<i class="far fa-trash-alt"></i></a>
                </div>
            </div>
        </div>

        <div class="containe">
            @if (session()->has('message'))
            <div class="alert alert-primary" role="alert">
                {{session()->get('message')}}
              </div>
            @endif
        </div>
        <div class="row">
            @foreach ($notes as $item)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{URL::asset($item->photo)}}" alt="No Picture for this">
                <div class="card-body">
                  <h5 class="card-title">{{$item->title}}</h5>
                  <p class="card-text">{{$item->content}}.</p>
                  <a href="{{route('note.show', ['id' => $item->id])}}" class="btn btn-primary">show</a>&nbsp;
                  <a href="{{route('note.destroy', ['id' => $item->id])}}" class="btn btn-danger">Delete</a>
                </div>
            </div> &nbsp;
            @endforeach
        </div>


    </div>

@endsection
