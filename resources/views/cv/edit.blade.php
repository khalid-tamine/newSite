@extends('layouts.app')

@section('content')



<div class="container"></div>
    <div class="row justify-content-center">
        <div class="col-md-6">
        <form action="{{ url('cvs/'.$cv->id) }}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}
            <div class="form-group @if($errors->get('titre')) has-error @endif">
                <label for="">titre</label>
                <input type="text" name="titre" class="form-control" value="{{ $cv->titre }}">
                @if($errors->get('titre'))
                    @foreach($errors->get('titre') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                @endif
            </div>
            <div class="form-group @if($errors->get('presentation'))  has-error @endif">
                <label for="">presentation</label>
                <textarea name="presentation" class="form-control">{{ $cv->presentation }}</textarea>
                @if($errors->get('presentation'))
                    @foreach($errors->get('presentation') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                @endif
            </div>
            <div class="form-group">
                    <labe>Image</labe>
                    <input class="form-control" type="file" name ="photo">
            </div>

            <div class="form-group">
                <input type="submit" value="Modifier" class="form-control btn btn-danger">
            </div>
        </form>
        </div>
    </div>
</div>

@endsection
