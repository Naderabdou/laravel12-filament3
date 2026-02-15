<?php

namespace App\Repositories;

use App\Models\ContactUs;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class ContactUsRepository extends BaseRepository
{
    /**
     * @param ContactUs $model
     */
    public function __construct(ContactUs $model)
    {
        parent::__construct($model);
    }

     /**
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model
    {
        return parent::store($data);
    }

   
}
