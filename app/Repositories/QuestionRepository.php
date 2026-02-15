<?php

namespace App\Repositories;

use App\Models\Question;
use App\Repositories\BaseRepository;

class QuestionRepository extends BaseRepository
{
    /**
     * @param Question $model
     */
    public function __construct(Question $model)
    {
        parent::__construct($model);
    }
   
}
