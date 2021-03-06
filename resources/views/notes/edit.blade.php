@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <form action="{{route('note.update', $note->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="exampleFormControlInput1">Note Title</label>
                  <input type="text" class="form-control" name="title" value="{{$note->title}}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Note Content</label>
                    <textarea class="form-control" name="content" rows="3">{{$note->content}}</textarea>
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
