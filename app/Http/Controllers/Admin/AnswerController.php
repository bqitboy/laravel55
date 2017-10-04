<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreAnswerRequest;
use App\Repositories\AnwserRepository;
use App\Http\Controllers\Controller;
use Auth;

class AnswerController extends Controller
{
    protected $answerRepository;

    public function __construct(AnwserRepository $anwserRepository)
    {
        $this->answerRepository = $anwserRepository;
    }

    public function store(StoreAnswerRequest $request, $question)
    {
        //dd($request->all());
        $answer = $this->answerRepository->create([
            'question_id' => $question,
            'user_id'     => Auth::id(),
            'contents'    => $request->get('contents')
        ]);
        //更新Question->answers_count字段
        $answer->question()->increment('answers_count');

        return back();
    }
}
