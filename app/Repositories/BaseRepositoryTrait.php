<?php

namespace CodePub\Repositories;
use Prettus\Repository\Eloquent\BaseRepository;



trait BaseRepositoryTrait
{
    public function lists($column, $key = null)
    {
        $this->applyCriteria();

        return $this->model->pluck($column,$key);
    }
}

