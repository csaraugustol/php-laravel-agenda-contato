<?php

namespace App\Repositories;

use App\Tag;
use App\Repositories\Contracts\TagRepository;

/**
 * Class BaseRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TagRepositoryEloquent extends BaseRepositoryEloquent implements TagRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tag::class;
    }
}
