<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $fillable = ['name', 'intro', 'questions_conunt'];

    public function questions()
    {
        //关联表 questions, belongsToMany 第二个值是第三张表, question_topic, 可省略不写
        return $this->belongsToMany(Question::class)->withTimestamps();
    }
}
