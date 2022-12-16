<?php

namespace App\Http\Controllers;

use App\Classes\RequestValidationHandler;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class AuthenticationController extends Controller
{

    use RequestValidationHandler;

    /*
     * @param Request $request
     * @return Application|Factory|View
     */
    public function authenticationPage(Request $request): View|Factory|Application
    {
        return view('auth.authentication', [
            'showLogin' => $request->is('login'),
            'page_css' => 'app_css.css',
            'page_js' => 'authentication.js'
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $validate = $this->validateRequest($request, 'register');
        if($validate->fails())
            return $this->errorsReturn($validate);

        try{

            $user = User::create([
                'username' => $request->request->get('username'),
                'email' => $request->request->get('email'),
                'password' => bcrypt($request->request->get('password')),
                'ip' => $request->ip()
            ]);

            auth()->login($user);

        }catch(\Exception $exception){
            return response()->json(['authError' => 'Something went wrong']);
        }

        return response()->json(['login' => 'success']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $isEmail = filter_var( $request->request->get('username_login', ''), FILTER_VALIDATE_EMAIL );

        $validate = $this->validateRequest($request, $isEmail === false ? 'login-username' : 'login-email');
        if($validate->fails())
            return $this->errorsReturn($validate);


        $userKey = $isEmail === false ? 'username' : 'email';
        $user = [
            $userKey => $request->request->get('username_login'),
            'password' => $request->request->get('password_login'),
        ];

        if (auth()->attempt($user)){
            $request->session()->regenerate();
            return response()->json(['login' => 'success']);
        }

        return response()->json(['authError' => 'Invalid Credentials']);
    }

    /**
     * @param Request $request
     * @return Redirector|Application|\Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request): Redirector|Application|\Illuminate\Http\RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'Logged out');
    }

}
