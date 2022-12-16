<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleAuthController extends Controller
{
    /**
     * @return mixed
     */
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector|void
     */
    public function callbackGoogle(Request $request)
    {
        try {
            $google_user = Socialite::driver('google')->stateless()->user();

            // User with google signup exists
            $user = User::where('google_id', $google_user->getId())->first();

            if (!$user){

                // Check if user has signed up with email/pw but not with google
                $userEmail = User::where('email', $google_user->getEmail())->first();
                if ($userEmail){
                    $userEmail->google_id = (string) $google_user->getId();
                    $userEmail->save();
                    $user = $userEmail;

                }else{
                    // Create new user with a uniqe username
                    $username = $this->findUniqueUsername($this->sanitizeEmailUsername($google_user->getEmail()));

                    $user = User::create([
                        'username' => $username,
                        'email' => $google_user->getEmail(),
                        'google_id' => (string) $google_user->getId(),
                        'ip' => $request->ip()
                    ]);
                }
            }

            auth()->login($user);
            return redirect(RouteServiceProvider::LOGGED_IN_HOME);

        }catch(Throwable $exception){
            return redirect('/register')->with('message', 'Something went wrong:' . $exception->getMessage());
        }
    }

    /**
     * To do: add to parent class if other social signups are used
     * @param $email
     * @return string
     */
    private function sanitizeEmailUsername($email)
    {
        $name = strtolower(explode('@', $email)[0] ?? '');
        $name = str_replace(['.', ' ', '-', '_'], '', $name);
        $name = trim(preg_replace('/[^\.\w\d_ -]/si', '', $name));
        return $this->findUniqueUsername($name);
    }

    /**
     * @param $name
     * @return string
     */
    private function findUniqueUsername($name)
    {
        while(User::where('username', $name)->first()){
            $name .= rand(1, 999);
            $this->findUniqueUsername($name);
        }
        return $name;
    }
}
