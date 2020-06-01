<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $user->update([
            'last_login_at' => now()
        ]);
        // Show greetings.
        notify()->success("Hey $user->name, Welcome Back!",'Success');
    }

    /**
     * Redirect the user to the provider authentication page.
     *
     * @param $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        // Find existing user.
        $existingUser = User::whereEmail($user->getEmail())->first();
        if ($existingUser)
        {
            Auth::login($existingUser);
        } else {
            // Create new user.
            $newUser = User::create([
                'role_id' => Role::where('slug','user')->first()->id,
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'status' => true
            ]);
            // upload images
            if ($user->getAvatar()) {
                $newUser->addMediaFromUrl($user->getAvatar())->toMediaCollection('avatar');
            }
            Auth::login($newUser);
        }
        notify()->success('You have successfully logged in with '.ucfirst($provider).'!','Success');
        return redirect($this->redirectPath());
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        // Show success msg.
        notify()->success('You have successfully logged out!','Success');
    }

}
