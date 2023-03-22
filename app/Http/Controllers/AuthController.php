<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected function createUser(Request $request)
    {
        $validateFields = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6'
        ]);
        $user = User::create([
            'name' => $validateFields['name'],
            'email' => $validateFields['email'],
            'password' => Hash::make($validateFields['password'])
        ]);
        if( $user )
        {
            Auth::login($user);
            return redirect()->to(route('index'));
        }
        return redirect(route(''))->withErrors([
            'formError' => 'Произошла ошибка при сохранении пользователя'
        ]);
    }
    protected function loginUser(Request $request)
    {
        $formFields = $request->only(['email', 'password']);
        $remember = $request->input('remember');
        if( Auth::attempt($formFields,$remember) )
        {
            return redirect()->intended(route('index'));
        }
        return redirect(route('index'))->withErrors([
            'email'=> 'Не удалось авторизироваться'
        ]);
    }
    protected function logoutUser()
    {
        Auth::logout();
        return redirect(route('index'));
    }
}
