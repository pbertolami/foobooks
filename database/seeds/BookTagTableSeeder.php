<?php

use Illuminate\Database\Seeder;

class BookTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [
            'The Great Gatsby' => ['novel', 'fiction', 'classic', 'wealth'],
            'The Bell Jar' => ['novel', 'fiction', 'classic', 'women'],
            'I know Why the Caged Bird Sings' => ['autobiography', 'nonfiction', 'classic', 'women']
        ];

        foreach ($books as $title => $tags) {
            $book = \Foobooks\Book::where('title', 'like', $title)->first();

            foreach ($tags as $tagName) {
                $tag = \Foobooks\Tag::where('name', 'LIKE', $tagName)->first();
                $book->tags()->save($tag);
            }
        }
    }
}
