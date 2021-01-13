<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    // /book
    public function index(){
        $books = Book::all();

        for($i = 0; $i < count($books); $i++){
            $filename = '';
            if(!empty($books[$i]['cover'])){
                $filename = htmlspecialchars($books[$i]['cover']);
            } else {
                $filename = 'no_image_found.jpg';
            }
            $coverpath = '/storage/images/media/'.$filename;
            if (!file_exists(public_path().$coverpath)){
                $coverpath = '/storage/images/media/no_image_found.jpg';
            }

            $books[$i]->coverpath = $coverpath;
        }

        $viewmodel = [
            'title' => 'List of Books',
            'books' => $books
        ];
        return view('pages.book.list', $viewmodel);
    }

    // /book/{id}
    public function details($id){
        // $book = Book::find($id);
        // $book = Book::where('id', $id)->first();
        $book = Book::findOrFail($id);

        $filename = '';
        if(!empty($book['cover'])){
            $filename = htmlspecialchars($book['cover']);
        } else {
            $filename = 'no_image_found.jpg';
        }
        $coverpath = '/storage/images/media/'.$filename;
        if (!file_exists(public_path().$coverpath)){
            $coverpath = '/storage/images/media/no_image_found.jpg';
        }

        $book->coverpath = $coverpath;

        $viewmodel = [
            'title' => 'Book Details',
            'book' => $book
        ];
        // print_r($viewmodel);
        return view('pages.book.details', $viewmodel);
    }

    // /book/add
    public function add(){
        $book = [
            'id' => '', 'title' => '', 'author' => '', 'isbn' => '', 'cover' => ''
        ];

        $viewmodel = [
            'title' => 'Add New Book',
            'book' => $book,
            'dberrors' => '',
            'errors' => ['title' => '', 'author' => '', 'isbn' => '', 'cover' => '']
        ];
        return view('pages.book.add', $viewmodel);
    }

    // /book (POST)
    public function add_post(Request $request){
        $title = $request->title;
        $author = $request->author;
        $isbn = $request->isbn;
        $cover = '';
        if ($request->hasFile('cover')){
            $file_tmp = $request->file('cover');
            $file_name = $request->file('cover')->getClientOriginalName();
            $file_ext = $request->file('cover')->getClientOriginalExtension();
            $file_size = $request->file('cover')->getSize();

            $cover = date("Ymdhis").'_'.$file_name;
            $extensions = array("jpeg","jpg","png");

            $target = "public/images/media";
            $path = $file_tmp->storeAs($target, $cover);
        }


        $book = new Book();
        $book->title = $title;
        $book->author = $author;
        $book->isbn = $isbn;
        $book->cover = $cover;

        $book->save();

        return redirect('/book');
    }

    // /book/edit/{id}
    public function edit($id){
        // $book = Book::find($id);
        // $book = Book::where('id', $id)->first();
        $book = Book::findOrFail($id);

        $filename = '';
        if(!empty($book['cover'])){
            $filename = htmlspecialchars($book['cover']);
        } else {
            $filename = 'no_image_found.jpg';
        }
        $coverpath = '/storage/images/media/'.$filename;
        if (!file_exists(public_path().$coverpath)){
            $coverpath = '/storage/images/media/no_image_found.jpg';
        }

        $book->oldcover = $book['cover'];
        $book->coverpath = $coverpath;

        $viewmodel = [
            'title' => 'Edit Book',
            'book' => $book,
            'dberrors' => '',
            'errors' => ['title' => '', 'author' => '', 'isbn' => '', 'cover' => '']
        ];

        return view('pages.book.edit', $viewmodel);
    }

    // /book/edit/{id} (POST)
    public function edit_post(Request $request, $id){
        $book = Book::findOrFail($id);
        if(!empty($book)){
            $book->title = $request->title;
            $book->author = $request->author;
            $book->isbn = $request->isbn;
            $oldcover = $request->oldcover;
            $cover = '';

            if ($request->hasFile('cover')){
                $oldcoverpath = '/storage/images/media/'.$oldcover;
                if (file_exists(public_path().$oldcoverpath)){
                    File::delete(public_path($oldcoverpath));
                }

                $file_tmp = $request->file('cover');
                $file_name = $request->file('cover')->getClientOriginalName();
                $file_ext = $request->file('cover')->getClientOriginalExtension();
                $file_size = $request->file('cover')->getSize();

                $cover = date("Ymdhis").'_'.$file_name;
                $extensions = array("jpeg","jpg","png");

                $target = "public/images/media";
                $path = $file_tmp->storeAs($target, $cover);
                $book->cover = $cover;
            }

            $book->update();
        }

        return redirect('/book');
    }
    // /book/{id} (delete)
    public function delete($id){
        $book = Book::findOrFail($id);
        $cover = $book->cover;

        $coverpath = '/storage/images/media/'.$cover;
        if (file_exists(public_path().$coverpath)){
            File::delete(public_path($coverpath));
        }

        $book->delete();

        return redirect('/book');
    }
}
