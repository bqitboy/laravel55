<?php

namespace App\Repositories;

use App\Models\admin\Question;
use App\Models\admin\Topic;

class QuestionRepository
{
    public function byIdWithTopicsAndAnswers($id)
    {
        return Question::where('id', $id)->with(['topics', 'answers'])->first();
    }

    //数据入库
    public function create(array $attributes)
    {
        return Question::create($attributes);
    }

    //编辑页面
    public function byId($id)
    {
        return Question::find($id);
    }

    public function normalizeTopic(array $topics)
    {
        return collect($topics)->map(function ($topic) {
            if (is_numeric($topic)) {
                //questions_conunt 自增1
                Topic::find($topic)->increment('questions_conunt');
                return (int)$topic;
            }
            $newTopic = Topic::create(['name' => $topic, 'questions_conunt' => 1]);
            return $newTopic->id;
        })->toArray();
    }

    public function getQuestionsFeed()
    {
        //return Question::published()->latest('updated_at')->with('users')->get();
        return  Question::latest('updated_at')->with('user')->get();
    }
}