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

                        <!-- 编辑器容器 -->
                            <script id="container" name="content" type="text/plain" ></script>
                        <br>
                        <button class="btn btn-success pull-right">发 布</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    </script>

@endsection
