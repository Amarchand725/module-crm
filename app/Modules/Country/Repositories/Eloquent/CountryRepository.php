<?php

namespace App\Modules\Country\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Modules\Country\Repositories\Contracts\CountryContract;
use App\Modules\Country\Models\Country;

class CountryRepository extends BaseRepository implements CountryContract
{
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }
}