<?php

namespace CodeEduBook\Repositories;


use CodePub\Criteria\CriteriaTrashedTrait;
use CodePub\Repositories\BaseRepositoryTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEduBook\Repositories\CategoryRepository;
use CodeEduBook\Models\Category;
use CodeEduBookValidators\CategoryValidator;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    use BaseRepositoryTrait;
    use CriteriaTrashedTrait;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function listsWithMutators($column, $key = null)
    {
        $colletion = $this->all();
        return $colletion->pluck($column, $key);
    }
}
