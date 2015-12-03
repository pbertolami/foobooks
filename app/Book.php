<?php

namespace Foobooks;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function author(){
        #Book blongs to Author
        #Define an inverse one-to-many relationship.
        return $this->belongsTo('\Foobooks\Author');
    }
    public function tags(){
        return $this->belongsToMany('\Foobooks\Tag')->withTimestamps();
    }
    protected $fillable = [
        'title',
        'page_count',
        'published',
        'cover',
        'purchase_link',
        'author_id'
    ];

}
