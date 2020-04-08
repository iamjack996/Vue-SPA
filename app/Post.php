<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function getDataList($with, $where, $method, $page = null)
    {
        $query = $this->with($with)->where($where);

        if ($page) return $query->{$method}($page);

        return $query->{$method}();
    }
}
