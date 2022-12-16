@extends('layouts.app')
@section('head_title', 'AuthPage AfterLight')


@section('page_css')
    @if(isset($page_css))
        <link rel="stylesheet" href="{{ staticsUrl($page_css) }}">
    @endif
@stop


@section('content')

    <div class="container">

        <div class="login-wrap auth-wrapper {{ $showLogin ? '' : 'hidden' }}">
            <h1><a href="/"> Afterlight</a></h1>
            <h2>Time to Login</h2>
            <div class="row">
              <span class="change-auth" data-change-to="register">Or register</span>
            </div>

            <form id="login-user-form" method="POST">

                <div class="row">
                    <div class="input-field col s6">
                        <input id="username_login" name="username_login" type="text" class="validate form-input" maxlength="50">
                        <label for="username_login">Username or Email</label>
                        <span class="form-error-message error-username_login"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input id="password_login" name="password_login" type="password" class="validate form-input" maxlength="50">
                        <label for="password_login">Password</label>
                        <span class="form-error-message error-password_login"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <button id="login-user">SUBMIT</button>
                    </div>
                </div>

            </form>

        </div>

        <div class="register-wrap auth-wrapper {{ $showLogin ? 'hidden' : '' }}" >

            <h1><a href="/"> Afterlight</a></h1>
            <h2>Time to Register</h2>

            <div class="row">
                <span class="change-auth" data-change-to="login">Or Login</span>
            </div>


            <form id="register-user-form" method="POST">
                <div class="row">

                    <div class="input-field col s6">
                        <input id="username" name="username" type="text" class="validate form-input" required maxlength="50">
                        <label for="username">Username</label>
                        <span class="form-error-message error-username"></span>
                    </div>

                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input id="email" name="email" type="email" class="validate form-input" required maxlength="50">
                        <label for="email">Email</label>
                        <span class="form-error-message error-email"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input id="password" name="password" type="password" class="validate form-input" required maxlength="50">
                        <label for="password">Password</label>
                        <span class="form-error-message error-password"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input id="password_confirm" name="password_confirm" type="password" class="validate form-input" required maxlength="50">
                        <label for="password_confirm">Confirm Password</label>
                        <span class="form-error-message error-password_confirm"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <button id="register-user">SUBMIT</button>
                    </div>
                </div>
            </form>

        </div>

        <span class="form-error-message default-message"></span>



        <br><br>

        <div class="row">
            <div class="input-field col s12">

                - or -
                <br><br>

                <div class="google-login-wrap">
                    <a  href="{{route('google-auth')}}" class="waves-effect waves-light btn"> G: Sign up with google</a>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('plugins')
    @if(isset($page_js))
        <script type="text/javascript" src="{{ staticsUrl($page_js) }}"></script>
    @endif
@stop
