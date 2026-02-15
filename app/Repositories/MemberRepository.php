<?php

namespace App\Repositories;

use App\Models\Member;
use App\Repositories\BaseRepository;

class MemberRepository extends BaseRepository
{
    /**
     * @param Member $model
     */
    public function __construct(Member $model)
    {
        parent::__construct($model);
    }

}
