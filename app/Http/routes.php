<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Drop the database do not use this route in production
if(App::environment('local')){
    Route::get('/drop', function(){
        DB::statement('DROP database foobooks');
        DB::statement('CREATE database foobooks');

        return 'Dropped foobooks; created foobooks.';
    });
};

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//book routes
Route::get('/', 'BookController@getIndex');
Route::get('/books', 'BookController@getIndex');

Route::get('books/show/{title?}', 'BookController@getShow');

Route::group(['middleware'=> 'auth'], function(){

    Route::get('/books/create', 'BookController@getCreate');
    Route::post('/books/create', 'BookController@postCreate');

    Route::get('books/edit/{id?}', 'BookController@getEdit');
    Route::post('books/edit', 'BookController@postEdit');
});
//practice implicit BookRoute
Route::controller('/practice','PracticeController');
/*
Route::get('/practice', function(){
    echo app()->environment();
});
Route:get('done', function(){
    echo config('app.url');
});




//Route for debugbar
Route::get('/practice', function() {

    $data = Array('foo' => 'bar');
    Debugbar::info($data);
    Debugbar::error('Error!');
    Debugbar::warning('Watch out…');
    Debugbar::addMessage('Another message', 'mylabel');

    return 'Practice';

});
*/
Route::get('rych', function(){

    $random = new Random();
    return $random->getRandomString(16);
});

//flyer routes
Route::get('/', function(){
    return view('home');
});
Route::get('/','PagesController@home');
Route::resource('flyers','FlyersController');
Route::get('{zip}/{street}','FlyersController@show');
Route::post('{zip}/{street}/photos',['as' => 'store_photo_path', 'uses'=> 'FlyersController@addPhoto']);



//test route for database
Route::get('/debug', function(){
    echo '<pre>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>h1>';
    if(config('app.debug'))echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>h1>';
    echo '<h1>Test Database Connection</h1>';
    try{
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    }
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }
    echo '</pre>';

});

