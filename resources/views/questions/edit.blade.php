@extends('layouts.app')

@section('content')

    @include('vendor.ueditor.assets')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">发布问题</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="/questions/{{ $question->id }}" method="post">
                            {!! method_field('PATCH') !!}
                            {!! csrf_field() !!}
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title">标题</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="标题" required value="{{ $question->title }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="topic">话题</label>
                                <select class="js-example-placeholder-multiple form-control" name="topic[]" multiple="multiple" id="topic">
                                    @foreach($question->topics as $topic)
                                        <option vlaue="{{ $topic->id }}" selected> {{ $topic->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label for="container">内容</label>
                                <!-- 编辑器容器 -->
                                <script id="container" name="content" type="text/plain" >{!! $question->content !!}</script>

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success pull-right">发 布</button>
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
            initialFrameHeight: 350
        });
        $(function () {
           ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
        });
        //select23
        //$('.js-example-basic-multiple').select2();
            $(document).ready(function () {
                function formatTopic(topic) {
                    return "<div class='select2-result-repository clearfix'>" +
                            "<div class='select2-result-repository__meta'>" +
                            "<div class='select2-result-repository__title'>" +
                            topic.name ? topic.name : "Laravel" + 
                            "</div></div></div>";
                }
                function formatTopicSelection(topic) {
                    return topic.name || topic.text;
                }
                $('.js-example-placeholder-multiple').select2({
                    tags: true,
                    placeholder: '选择相关话题',
                    minimumInputLength: 2,
                    ajax: {
                        url: "/api/topics",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                q: params.term
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: data
                            };
                        },
                        cache: true
                    },
                    templateResult: formatTopic,
                    templateSelection: formatTopicSelection,
                    escapeMarkup: function (markup) { return markup; }
                })
            })
    </script>
    @endsection
@endsection
