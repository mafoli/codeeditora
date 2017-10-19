<?php

namespace CodeEduBook\Repositories;

use CodePub\Criteria\CriteriaTrashedInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategoryRepository
 * @package namespace CodePub\Repositories;
 */
interface BookRepository extends RepositoryInterface, RepositoryCriteriaInterface,CriteriaTrashedInterface,RepositoryRestoreInterface
{
    //
}
