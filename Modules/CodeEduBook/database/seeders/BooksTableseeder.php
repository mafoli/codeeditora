<?php

use Illuminate\Database\Seeder;

class BooksTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = \CodePub\Models\Category::all();
        factory(\CodePub\Models\Book::class,50)->create()->each(function ($book) use($categories){
            $categoriesRandom = $categories->random(4);
            $book->categories()->sync($categoriesRandom->pluck('id')->all());
        });
    }
}


