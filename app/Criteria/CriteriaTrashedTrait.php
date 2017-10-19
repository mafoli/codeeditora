<?php
namespace CodePub\Criteria;
use CodePub \Criteria\FindWithTrashedCriteria;
use CodePub\Criteria\FindOnlyTrashedCriteria;

trait CriteriaTrashedTrait{
    public function onlyTrashed(){
        $this->pushCriteria(FindOnlyTrashedCriteria::class);
        return $this;
    }

    public function withTrashed(){
        $this->pushCriteria(FindWithTrashedCriteria::class);
        return $this;
    }
}