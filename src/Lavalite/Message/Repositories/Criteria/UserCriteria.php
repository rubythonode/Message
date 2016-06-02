<?php

namespace Lavalite\Message\Repositories\Criteria;

use Litepie\Contracts\Repository\Criteria;
use Litepie\Contracts\Repository\Repository;

class UserCriteria implements Criteria
{

    public function apply($model, Repository $repository)
    {
        $model = $model->where('user_id', '=', user_id());
        return $model;
    }
}
