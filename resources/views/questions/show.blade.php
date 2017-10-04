@extends('layouts.app')

@section('style')
    <style>
        .panel-body img {
            width: 100%;
        }
    </style>
@endsection

@section('content')
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
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
