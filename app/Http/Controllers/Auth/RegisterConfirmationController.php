<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterConfirmationController extends Controller
{
    public function index()
    {
        try {
            $user = User::where('confirmation_token', request('token'))
            ->firstOrFail();
            
            $user->confirmed          = true;
            $user->confirmation_token = null;
            $user->save();
            
            return redirect('/login')
                ->with([
                    'flash' => [
                        'level'   => 'success',
                        'message' => 'Your account has been successfully verified. You may now login.'
                    ]
                ]);
        } catch (Exception $e) {
            return redirect('/login')
                ->with([
                    'flash' => [
                        'level'   => 'danger',
                        'message' => 'An invalid user confirmation token was submitted.'
                    ]
                ]);
        }
    }
}
