<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * ログイン処理
     */
    public function login(Request $request)
    {
        // バリデーション
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 認証試行
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'ログインしました！');
        }

        // 認証失敗
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->onlyInput('email');
    }

    /**
     * ログアウト処理
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'ログアウトしました！');
    }

    public function register(RegisterRequest $request)
    {
        // バリデーション済みデータを取得
        $validated = $request->validated();

        // ユーザー作成
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // 自動ログイン
        Auth::attempt($request->only('email', 'password'));

         // リダイレクト先を users.profile に設定
        return redirect()->route('users.profile')->with('success', '会員登録が完了しました！プロフィールを設定してください。');
    }
}
