<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Repositories\BaseRepository;

class BlogRepository extends BaseRepository
{
    /**
     * @param Blog $model
     */
    public function __construct(Blog $model)
    {
        parent::__construct($model);
    }
   
}
