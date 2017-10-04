<?php
/**
 * Created by PhpStorm.
 * User: dangran
 * Date: 2017/10/4
 * Time: 下午3:39
 */

namespace App\Repositories;


use App\Models\admin\Answer;

class AnwserRepository
{
    //数据入库
    public function create(array $attributes)
    {
        return Answer::create($attributes);
    }
}