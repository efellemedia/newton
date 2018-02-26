<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Exception;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialLoginController extends Controller
{
    /**
     * Show the form for logging in.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }
    
    /**
     * Redirect the user to the social service authentication page.
     *
     * @param  String  $service
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function redirect(Request $request)
    {
        return Socialite::driver('efelle')->redirect();
    }
    
    /**
     * Obtain the user information from the social service.
     *
     * @param  String  $service
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function callback(Request $request)
    {
        $serviceUser = Socialite::driver('efelle')->user();
        
        $user = $this->getExistingUser($serviceUser, 'efelle');
        
        if (! $user) {
            $user = User::create([
                'email'     => $serviceUser->getEmail(),
                'name'      => $serviceUser->getName(),
                'confirmed' => true,
            ]);
        }
        
        if ($this->needsToCreateSocialLink($user, 'efelle')) {
            $user->social()->create([
                'social_id' => $serviceUser->getId(),
                'service'   => 'efelle',
            ]);
        }
        
        Auth::login($user, false);
        
        return redirect()->intended();
    }
    
    protected function needsToCreateSocialLink(User $user, $service)
    {
        return ! $user->hasSocialLink($service);
    }
    
    protected function getExistingUser($serviceUser, $service)
    {
        return User::where('email', $serviceUser->getEmail())->orWhereHas('social', function ($query) use ($serviceUser, $service) {
            $query->where('social_id', $serviceUser->getId())->where('service', $service);
        })->first();
    }
}
