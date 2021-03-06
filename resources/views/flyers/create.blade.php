@extends('layout')



@section('content')

    <h1>Selling Your Home?</h1>
    <hr>

        <form method="POST" action="/flyers" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    {{csrf_field()}}


                        <div class="form-group">

                            <label for="street">Street:</label>
                            <input type="text" name="street" id="street" class="form-control" value="{{old('street')}}">

                        </div>
                        <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text" name="city" id="city" class="form-control" value="{{old('city')}}">

                        </div>

                        <div class="form-group">
                            <label for="zip">Zip/Postal Code:</label>
                            <input type="text" name="zip" id="zip" class="form-control" value="{{old('zip')}}">

                        </div>
                        <div class="form-group">
                            <label for="country">Country:</label>
                            <select name="country" id="country" class="form-control">
                                @foreach (Foobooks\Http\Utilities\Country::all() as $country)
                                    <option value="{{$country}}">{{$country}}</option>
                                    @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="state">State:</label>
                            <input type="text" name="state" id="state" class="form-control" value="{{old('state')}}">
                        </div>
                    <hr>
                    </div>




                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">Sale Price:</label>
                            <input type="text" name="price" id="price" class="form-control" value="{{old('price')}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Home Description</label>
                            <textarea type="text" name="description" id="description" class="form-control" rows="10">
                                {{old('description')}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="photos">Photos:</label>
                            <input type="file" name="photos" id="photos" class="form-control" value="{{old('photos')}}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create Flyer</button>
                        </div>
                    </div>
                </div>
        </form>
    <div>
        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

@stop