<?php

namespace CodeEduBook\Models;

use Bootstrapper\Interfaces\TableInterface;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model implements TableInterface
{
    use FormAccessible;
    use SoftDeletes;


    protected $fillable=[
        'title',
        'subtitle',
        'price',
        'author_id'

    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     *

     */
    public function formCategoriesAttribute(){

        return $this->categories->pluck('id')->all();
    }

    public function getTableHeaders()
    {
        return['id','Titulo','Autor','Preço'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case'id':
                return $this->id;
            case 'Titulo':
                return $this->title;

            case 'Preço':
                return $this->price;
            case 'Autor':
                return $this->author->name;
        }


    }

    public function categories(){

        return $this->belongsToMany(Category::class)->withTrashed();
    }
}
