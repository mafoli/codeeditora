<?php

namespace CodeEduBook\Repositories;


use CodePub\Criteria\CriteriaTrashedTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEduBook\Models\Book;
use CodePub\Validators\CategoryValidator;
use CodeEduBook\Repositories\BookRepository;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class BookRepositoryEloquent extends BaseRepository implements BookRepository
{

    use BaseRepositoryTrait;
    use CriteriaTrashedTrait;
    use RepositoryRestoreTrait;
    protected $fieldSearchable =[
        'title' => 'like',
        'author.name' =>'like'
    ];

    public function create(array $attributes)
    {
        $model = parent:: create($attributes);
        $model->categories()->sync($attributes['categories']);
        return $model;
    }

    public function update(array $attributes, $id)
    {
        $model = parent:: update($attributes);
        $model->categories()->sync($attributes['categories']);
        return $model;
    }


    /**
     * Specify Model class name
     *
     * @return string
     */



    public function model()
    {
        return Book::class;

    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
