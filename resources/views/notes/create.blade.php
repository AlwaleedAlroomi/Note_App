@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
         @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $item)
                <div class="alert alert-danger" role="alert">
                    {{$item}}
                </div>
            @endforeach
        </ul>
        @endif
            <form action="{{route('note.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="exampleFormControlInput1">Note Title</label>
                  <input type="text" class="form-control" name="title">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Note Content</label>
                    <textarea class="form-control" name="content" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Photo</label>
                  <input class="form-control" type="file" name="photo">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-danger">Save</button>
                </div>
              </form>
        </div>
    </div>
</div>
@endsection
