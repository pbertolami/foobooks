<?php

namespace Foobooks\Http\Controllers;

use Illuminate\Http\Request;
use Foobooks\Http\Requests;
use Foobooks\Http\Controllers\Controller;


class BookController extends Controller
{

    public function __construct()
    {
        //put anything here that should happen before any of the other actions
    }
    //Responds to requests to GET /books
    public function getIndex(Request $request)
    {
        $books = \Foobooks\Book::orderBy('id', 'DESC')->get();

       dump($books->toArray());
        return view('books.index')->with('books', $books);
    }
    public function getEdit($id = null)
    {
        $book = \Foobooks\Book::find($id);
        $authors = \Foobooks\Author::orderby('last_name','ASC')->get();
        dump($authors);
        $authors_for_dropdown =[];
        foreach($authors as $author) {
            $authors_for_dropdown[$author->id] = $author->last_name.', '.$author->first_name;
        }
        dump($authors_for_dropdown);
        //if we don't find the book
        if(is_null($book)){
            \Session::flash('flash_message', 'Book not found.');
            return redirect('\books');
        }
        //return view('books.edit')->with(['book'=>$book, 'authors_for_dropdown'=>$authors_for_dropdown]);
        return view('books.edit')->with(['book'=>$book, 'authors_for_dropdown' => $authors_for_dropdown]);
    }
    public function postEdit(Request $request){
        $book = \Foobooks\Book::find($request->id);

        $book->title = $request->title;
        $book->author_id = $request->author;
        $book->cover = $request->cover;
        $book->published = $request->published;
        $book->purchase_link = $request->purchase_link;

        $book->save();
        \Session::flash('flash_message', 'Your book was updated');
        return redirect('/books/edit/'.$request->id);

}

    public function getShow($title=null){

        return view ('books.show')->with('title', $title);
    }


    public function getCreate()
    {
        return view('books.create');
    }

    //Responds to requests to POST /books/create
    public function postCreate(Request $request)
    {
        $this->validate($request,
            [
                'title'     => 'required|min:5',
                'author'    => 'required|min:5',
                'cover'     => 'required|url',
                'published' => 'required|min:4',
            ]
        );
        //Code here to enter book into the database
        $book = new \Foobooks\Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->author_id = $request->author;
        $book->cover = $request->cover;
        $book->published = $request->published;
        $book->purchase_link = $request->purchase_link;

        $book->save();

        //Confirm book was added:
        //send session flash message
        //return view
        \Session::flash('flash_message', 'Your book was added!');

        return redirect('/books');
    }


}
