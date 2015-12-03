<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table){
            #Increments method will make a Primary, Auto-Incrementing field.
            #Most tables start off this way
            $table->increments('id');
            #this generates two columns: created_at and updated_at to keep
            #track of changes
            $table->timestamps();
            #The rest of the fields
            $table->string('title');
            $table->integer('page_count');
            $table->integer('published');
            $table->string('cover');
            $table->string('purchase_link');
            //No longer need the author now that we've
            //implemented the One to Many author relationship
            //$table->string('author');

            #FYI: We're skippping the 'tags' fields for now more on that later

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('books');
    }
}