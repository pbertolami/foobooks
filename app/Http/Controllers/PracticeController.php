<?php

namespace Foobooks\Http\Controllers;

use Illuminate\Http\Request;
use Foobooks\Http\Requests;
use Foobooks\Http\Controllers\Controller;
use Auth;

class PracticeController extends Controller
{
    function getExample6(){

        $books = \Foobooks\Book::orderBy('id','DESC')->get();
        //$first = \Foobooks\Book::orderBy('id', 'DESC')->first();
        //$last = \Foobooks\Book::orderBy('id','ASC')->first();
        $first = $books->first();
        $last = $books->last();

        dump($books);
        dump($first);
        dump($last);
      //return view('books.index')->with('books', $books);
       // echo $books;
        /*
        foreach($books as $book){
            echo $book->title;
        }
        */
    }
    function getExample7(){
        $author = new \Foobooks\Author;
        $author->first_name = 'J.K.';
        $author->last_name = 'Rowling';
        $author->bio_url = 'https://en.wikipedia.org/wiki/J._K._Rowling';
        $author->birth_year = '1965';
        $author->save();
        dump($author->toArray());

        $book = new \Foobooks\Book;
        $book->title = "Harry Potter and the Philosopher's Stone";
        $book->published = 1997;
        $book->cover = 'http://prodimage.images-bn.com/pimages/9781582348254_p0_v1_s118x184.jpg';
        $book->purchase_link = 'http://www.barnesandnoble.com/w/harrius-potter-et-philosophi-lapis-j-k-rowling/1102662272?ean=9781582348254';
        $book->author()->associate($author); # <--- Associate the author with this book
        $book->save();
        dump($book->toArray());

        return 'Example 7';
    }
    function getExample8(){
        $book = \Foobooks\Book::with('author')->orderBy('id', 'DESC')->first();
        dump($book->toArray());
        echo $book->title;
        echo $book->author;

        return 'Example 8';
    }
    function getExample9(){
        #eager load the authors with the books
        $books = \Foobooks\Book::with('author')->get();
        dump($books->toArray());
        foreach($books as $book) {

            echo $book->author->first_name.' '.$book->author->last_name.' wrote '.$book->title.'<br>';

        }
        dump($books->toArray());
    }
    function getExample10(){
        $book = \Foobooks\Book::where('title', '=', 'The Great Gatsby')->first();

        echo $book->title.' is tagged with: ';
        foreach($book->tags as $tag){
            echo $tag->name.' ';
        }
    }
    function getExample11(){
        $books = \Foobooks\Book::with('tags')->get();

        foreach($books as $book){
            echo '<br>'.$book->title.' is tagged with: ';
            foreach($book->tags as $tag){
                echo $tag->name.' ';
            }
        }
    }
    function getExample100(){
        $books = \Foobooks\Book::with('author')->get();
        foreach($books as $book){
            echo '<br>'.$book->title.' is written by: '.$book->author->first_name;

            }
        }
    function getExample12(){
        #get the current logged in user
        $user = \Auth::user();
        if($user){
            echo 'Hi logged in user '.$user->name.'<br>';
        }
        #get a user from the database
        $user = \Foobooks\User::where('name', 'like', 'Jamal')->first();
        echo 'Hi '.$user->name.'<br>';
    }
    function getExample13(){

        dump(\Auth::check());
        dump(Auth::check());
        dump(auth()->check());
    }
}

