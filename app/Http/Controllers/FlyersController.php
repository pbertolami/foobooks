<?php

namespace Foobooks\Http\Controllers;

use Foobooks\Flyer;
use Foobooks\Http\Requests\FlyerRequest;
use Foobooks\Photo;
use Illuminate\Http\Request;
use Foobooks\Http\Requests;
use Foobooks\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class FlyersController extends Controller
{
    //this constructor is for the autorization in the middleware
    public function _construct(){


        $this->middleware('auth',['except' => ['show']]);

        parent::_construct();
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //to return a view
        return view('flyers/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\FlyerRequest $request)
    {
        //validate the form using form request \FlyerRequest

        //persist the flyer
        Flyer::create($request->all());
        //show flash message
        \Session::flash('flash_message',"Your entry was added!");
        //redirect to landing page
        return redirect()->back();
    }

    /*
     * This shows the results of the scopeLocatedAt query, (the query is in the model Flyer.php)
     * It displays the results of the query on the flyers.show page whose view we return with this function
     *
     * Actually I just changed the scopeLocatedAt query to a static method but the function below
     * works with that as well
     */
    public function show($zip,$street)
    {
        $flyer = Flyer::locatedAt($zip, $street);
        return view('flyers.show', compact('flyer'));
    }



    public function addPhoto($zip, $street, Request $request){

        $this->validate($request,[
            'photo'=> 'required|mimes:jpg,jpeg,png,mp3,bmp'
        ]);

        //$photo = Photo::fromForm($request->file('photo'))->store();
        $photo = $this->makePhoto($request->file('photo'));
        //find the current flyer, link between flyer and photo
        Flyer::locatedAt($zip, $street)->addPhoto($photo);

    }


    protected function makePhoto(UploadedFile $file){

        //return Photo::fromForm($file)->store($file);
        return Photo::named($file->getClientOriginalName())
        ->move($file);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
