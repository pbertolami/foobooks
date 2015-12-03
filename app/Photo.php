<?php

namespace Foobooks;
use Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    protected $table = 'flyer_photos';

    protected $fillable = ['path', 'name', 'thumbnail_path'];

    protected $baseDir = 'images/photos';


    public function flyer()
    {
        return $this->belongsTo('Foobooks\Flyer');
    }
    public static function named($name){
        $photo = new static;
        //current time stamp plus original name gets a unique identifier for each picture
        //$name = time() . $file->getClientOriginalName();
        return $photo->saveAs($name);
        //$photo->path = $photo->baseDir . '/' . $name;
        //$file->move($photo->baseDir, $name);


    }

    public function saveAs($name){
        $this->name = sprintf('%s-%s', time(), $name);
        $this->path = sprintf('%s/%s', $this->baseDir, $this->name);
        $this->thumbnail_path = sprintf("%s/tn-%s", $this->baseDir, $this->name);

        return $this;
    }
    public function move(UploadedFile $file){

        $file->move($this->baseDir, $this->name);

        $this->makeThumbnail();

        return $this;
    }
    public function makeThumbnail(){

        Image::make($this->path)
            ->fit(200)
            ->save($this->thumbnail_path);



    }

}

