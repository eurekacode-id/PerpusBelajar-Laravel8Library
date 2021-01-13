@extends('layouts.base_layout')
@section('content')

<h3 class="display-4 text-center">{{ $title }}</h3>
@if(!empty($book))

    <div class="row justify-content-center m-3">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $book->title }}</h2>
                </div>
                <div class="card-body text-center">
                    <img class="card-img-top imageThumbnail"
                    src="{{ asset($book->coverpath) }}"
                    alt="{{ $book->title }}" />
                    <h4>ISBN: {{ $book->isbn }}</h4>
                    <h4>Author: {{ $book->author }}</h4>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ url('/book')}}" class="btn btn-primary" >Back</a>
                    <a href="/book/edit/{{ $book->id }}" class="btn btn-primary">Edit</a>
                    <form action="/book/{{ $book->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" name="delete" value="Delete" class="btn btn-danger"/>
                    </form>
                    <!-- <a href="#" class="btn btn-danger">Delete</a> -->
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row justify-content-center m-3">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h2>Ooops, book not found</h2>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ url('/book/list')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
