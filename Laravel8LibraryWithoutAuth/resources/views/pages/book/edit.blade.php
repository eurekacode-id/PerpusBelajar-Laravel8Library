@extends('layouts.base_layout')
@section('content')

<h3 class="display-4 text-center">{{ $title }}</h3>

<form class="site-form" enctype="multipart/form-data" action="/book/edit/{{ $book->id }}" method="POST">
    @csrf
    <div class="card-deck">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-3">
                        Title
                    </div>
                    <div class="col-md-9">
                        {{-- <input type="hidden" name="id" value="{{ $book->id }}"/> --}}
                        <input type="text" name="title" value="{{ $book->title }}"/>
                        <p><span class="text-danger">{{ $errors['title'] }}</span></p>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        ISBN
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="isbn" value=" {{ $book->isbn }}"/>
                        <p><span class="text-danger">{{ $errors['isbn'] }}</span></p>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        Author
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="author" value=" {{ $book->author }}"/>
                        <p><span class="text-danger">{{ $errors['author'] }}</span></p>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        Old Cover
                    </div>
                    <div class="col-md-9">
                        <input type="hidden" name="oldcover" id="oldcover" value="{{ $book->oldcover }}"/>
                        <img class="card-img-top imageThumbnail"
                        style="width:200px; height:auto;"
                        src="{{ asset($book->coverpath) }}"
                        alt="{{ $book->title }}"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        Book Cover
                    </div>
                    <div class="col-md-9">
                        <input type="file" name="cover" id="cover"/>
                        <span class="text-danger">{{ $errors['cover'] }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <p><span class="text-danger">{{ $dberrors }}</span></p>
                    </div>
                </div>
                <div class="form-group row">
                    <input type="submit" name="submit" class="btn btn-primary" value="Save">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
