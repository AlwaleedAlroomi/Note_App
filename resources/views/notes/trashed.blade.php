@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="jumbotron">
                    <p class="lead"><strong>All Deleted Notes.</strong></p>
                    <a class="btn btn-primary" href="{{route('notes')}}">All Notes</a>
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
                  <a href="{{route('note.restore', ['id' => $item->id])}}" class="btn btn-primary">Restore&nbsp;<i class="fas fa-trash-restore"></i></a>&nbsp;
                  <a href="{{route('note.hdelete', ['id' => $item->id])}}" class="btn btn-primary">Force Delete&nbsp;<i class="far fa-trash-alt"></i></a>
                </div>
            </div> &nbsp;
            @endforeach
        </div>


    </div>

@endsection
