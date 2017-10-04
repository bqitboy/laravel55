<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreQuestionRequest;
use App\Repositories\QuestionRepository;
use App\Http\Controllers\Controller;
use Auth;

class QuestionController extends Controller
{
    protected $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        //验证是否登陆
        $this->middleware('auth')->except(['index', 'show']);
        $this->questionRepository = $questionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return '111111';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('questions.make');
    }

    /**
     *
     * @param StoreQuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreQuestionRequest $request)
    {
        //字段验证
//        $rules = [
//            'title' =>  'required|min:6|max:196',
//            'content'   =>  'require|min:10'
//        ];
//
//        $this->validate($request, $rules);
        //话题id
        $topics = $this->questionRepository->normalizeTopic($request->get('topic'));
        $data = [
            'title'   => $request->get('title'),
            'content' => $request->get('content'),
            'user_id' => Auth::id()
        ];
        //数据入库
        //$question = Question::create($data);
        $question = $this->questionRepository->create($data);
        //关联表更新
        $question->topics()->attach($topics);

        return redirect()->route('question.show', [$question->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //根据id获取关联话题(标签)
        //$question = Question::where('id', $id)->with('topics')->first();
        $question = $this->questionRepository->byIdWithTopics($id);
        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $question = $this->questionRepository->byId($id);
        //判断是否为作者
        if (Auth::user()->owns($question)) {
            return view('questions.edit', compact('question'));
        }
        //返回上一步
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuestionRequest $request, $id)
    {
        $question = $this->questionRepository->byId($id);
        $topics = $this->questionRepository->normalizeTopic($request->get('topic'));
        //数据入库
        $question->update([
            'title'   => $request->get('title'),
            'content' => $request->get('content')
        ]);
        //关联表更新 sync(数据同步)
        $question->topics()->sync($topics);
        return redirect()->route('question.show', [$question->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
