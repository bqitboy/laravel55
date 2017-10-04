@extends('layouts.app')

@section('style')
    <style>
        .panel-body img {
            width: 100%;
        }
    </style>
@endsection

@section('content')
    @include('vendor.ueditor.assets')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $question->title }}
                        @foreach($question->topics as $key => $val)
                            <i class="btn btn-xs btn-info">{{ $val->name }}</i>
                        @endforeach
                    </div>

                    <div class="panel-body">
                        {!! $question->content !!}
                        @if(Auth::check() && Auth::user()->owns($question))
                            <a href="/questions/{{ $question->id }}/edit" class="btn btn-xs btn-success">编 辑</a>
                            <form action="/questions/{{ $question->id }}" method="post" class="delete-from">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="btn btn-xs btn-danger">删 除</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $question->answers_count }} 个回答</div>

                    <div class="panel-body">

                        @foreach($question->answers as $answer)
                            <div class="media">
                                <div class="media-left">
                                    <a href="">
                                        <img width="48" src="{{ $answer->user->avatar }}" alt="{{ $answer->user->name }}">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="/questions/{{ $answer->id }}">
                                            {!! $answer->contents !!}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        @endforeach

                        <form action="/questions/{{ $question->id }}/answer" method="post">
                            {!! csrf_field() !!}
                            <div class="form-group{{ $errors->has('contents') ? ' has-error' : '' }}">
                                <!-- 编辑器容器 -->
                                <script id="container" name="contents" type="text/plain" ></script>

                                @if ($errors->has('contents'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contents') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success pull-right">提交答案</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('js')
        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('container', {
                toolbars: [
                    [
                        'bold',
                        'italic',
                        'underline', //下划线
                        'fontsize', //字体大小
                        'strikethrough',
                        'blockquote',
                        'insertunorderedlist',
                        'insertorderedlist',
                        'justifyleft',
                        'justifycenter',
                        'justifyright',
                        'link', //超链接
                        'insertimage',
                        'fullscreen' //全屏
                    ]
                ],
                elementPathEnabled: false,
                enableContextMenu: false,
                autoClearEmptyNode: true,
                wordCount: false,
                imagePopup: false,
                autotypeset:{ indent: true,imageBlockLine: 'center' },
                initialFrameHeight: 120
            });
            $(function () {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
            });
        </script>
    @endsection

@endsection
