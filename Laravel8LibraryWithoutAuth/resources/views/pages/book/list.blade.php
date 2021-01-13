@extends('layouts.base_layout')
@section('content')
<div class="jumbotron">
    <div class="text-center">
        <h1>
            Enjoy the collection of TheLibrary!
        </h1>
    </div>
</div>
{{-- @if($user['user_role'] === 'ADMIN') --}}
<div class="row">
    <a href="/book/add" class="btn btn-success btn-block">Add new book</a>
</div>
{{-- @endif --}}
<div class="row">
    <div class="card-deck">
        @if(!empty($books))
            @foreach($books as $book)
                <div class="card card-m3" style="min-width:18rem;max-width:30.5%;">
                    {{-- <div class="card-header"><h3>{{ $book['title'] }}</h3></div> --}}
                    <div class="card-header"><h3>{{ $book->title }}</h3></div>
                    {{-- <img class="card-img-top imageThumbnail"
                    style="height:500px; width:auto;"
                    src="{{ $book['coverpath'] }}"
                    alt="{{ $book['title'] }}"/> --}}
                    <img class="card-img-top imageThumbnail"
                    style="height:500px; width:auto;"
                    src="{{ asset($book->coverpath) }}"
                    alt="{{ $book->title }}"/>
                    <div class="card-footer text-center">
                        {{-- <a class="btn btn-primary" href="/book/{{ $book['id'] }}">View</a> --}}
                        <a class="btn btn-primary" href="/book/{{ $book->id }}">View</a>
                        {{-- @if($user['user_role'] === 'ADMIN') --}}
                        {{-- <a href="/book/edit/{{ $book['id'] }}" class="btn btn-primary">Edit</a> --}}
                        <a href="/book/edit/{{ $book->id }}" class="btn btn-primary">Edit</a>
                        <form action="/book/{{ $book->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" name="delete" value="Delete" class="btn btn-danger"/>
                        </form>
                        {{-- @endif --}}
                    </div>
                </div>
            @endforeach
        @else
        <p>Sorry, there is no book to display currently</p>
        @endif
    </div>
</div>
@stop
