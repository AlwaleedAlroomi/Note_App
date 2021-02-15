@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 25rem;">
                    <img class="card-img-top" src="{{URL::asset($note->photo)}}" alt="{{$note->photo}}">
                    <div class="card-body">
                      <h5 class="card-title">{{$note->title}}</h5>
                      <p class="card-text">{{$note->content}}.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
