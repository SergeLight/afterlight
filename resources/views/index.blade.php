@extends('layouts.app')
@section('head_title', 'Homepage AfterLight')

@section('page_css')
    @if(isset($page_css))
        <link rel="stylesheet" href="{{ staticsUrl($page_css) }}">
    @endif
@stop

@section('content')

    <div class="container">
        <h1>Afterlight</h1>
        <h2>Welcome!</h2>
        <div class="row">

            <a href="/login">Enter here</a>
        </div>

        <br>
        <br>
    </div>


@endsection

@section('plugins')
    @if(isset($page_js))
        <script type="text/javascript" src="{{ staticsUrl($page_js) }}"></script>
    @endif
@stop
