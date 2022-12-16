@extends('layouts.app')
@section('head_title', 'Wall AfterLight')


@section('page_css')
    @if(isset($page_css))
        <link rel="stylesheet" href="{{ staticsUrl($page_css) }}">
    @endif
@stop


@section('content')

    <div class="container">

        <div class="row">
            <h1>Afterlight</h1>
            <h2>Welcome to your wall <span style="color:red;">{{auth()->user()->username}}</span></h2>
        </div>

    </div>

@endsection

@section('plugins')
    @if(isset($page_js))
        <script type="text/javascript" src="{{ staticsUrl($page_js) }}"></script>
    @endif
@stop
