<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = ['title', 'content', 'user_id'];

    public function topics()
    {
        //关联表 topics, belongsToMany 第二个值是第三张表, question_topic, 可省略不写
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
//    public function scopePublished($query)
//    {
//        //依据默一字段是否为true 进行判断 类似是否 「显示」
//        return $query->where('is_xxx', 'T');
//    }
}
