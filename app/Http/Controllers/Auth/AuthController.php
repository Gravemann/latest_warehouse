<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\User;
use App\Models\UserImage;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            "name" => $data['name'],
            "email" => $data['email'],
            "password" => bcrypt($data['password']) 
        ]);

        $image_svg = file_get_contents('https://ui-avatars.com/api/?format=svg&rounded=true&background=000006&color=818cf8&name=' . $request->name);

        UserImage::create([
            'user_id' => $user->id,
            'image_svg' => $image_svg
        ]);

        if ($user) {
            event(new Registered($user));
            auth('web')->login($user);
            return to_route('verification.notice')->with('email', $user->email);
        }

        return to_route('login.view');
    }

    public function login(LoginUserRequest $request)
    {
        $data = $request->validated();

        if (auth('web')->attempt($data, $request->filled('remember'))) {
            if (auth()->user()->hasVerifiedEmail()) {
                $request->session()->regenerate();
                return to_route('brands.main');
            } else {
                $request->session()->regenerate();
                return to_route('verification.notice');
            }
        }

        return back()->withErrors(['fail' => 'User not found or credentials do not match']);
    }

    public function access_token()
    {
        if(auth()->user()->tokens()->count() > 0) {
            return 'You already have a token';
        } else {
            return ['api_token' => auth()->user()->createToken('api_token')->plainTextToken];
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        auth('web')->logout();
        return to_route('login.view');
    }

}
