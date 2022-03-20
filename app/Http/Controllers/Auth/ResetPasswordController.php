<?php

namespace App\Http\Controllers\Auth;

use App\Distributor;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    const VALIDATION_RULES = [
        'current_password' => 'required|string|min:8',
        'new_password' => 'required|string|min:8',
        'new_password_confirm' => 'required|string|min:8|same:new_password'
    ];

    const VALIDATION_MESSAGES = [
        'current_password.min' => 'Password minimal 8 karakter',

    ];
    
    public function resetPassword(Request $request): JsonResponse
    {

        $request->validate(self::VALIDATION_RULES, self::VALIDATION_MESSAGES);

        $user = $request->user();
        $pass = $request->get('current_password');
        $newPass = $request->get('new_password');
        if (!$this->assertPasswordEqual($user, $pass)) {
            return response()->json(['message' => 'password saat ini yang anda masukan salah'], 400);
        }
        $this->setUserPassword($user, $newPass);
        $user->save();

        return response()->json([
            'user' => $user
        ]);
    }

    public function resetPasswordWeb(Request $request)
    {

        $request->validate([
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8',
            'new_password_confirm' => 'required|string|min:8|same:new_password'
        ], [
            'current_password.min' => 'Password minimal 8 karakter',
        ]);

        $user = $request->user();
        $pass = $request->get('current_password');
        $newPass = $request->get('new_password');
        if (!$this->assertPasswordEqual($user, $pass)) {
            return response()->json(['message' => 'password saat ini yang anda masukan salah'], 400);
        }
        $this->setUserPassword($user, $newPass);
        $user->save();

        Auth::logout();

        return redirect('/');
    }

    private function assertPasswordEqual($user, $password): bool
    {
        return Hash::check($password, $user->password);
    }

    protected function setUserPassword($user, $password)
    {
        $user->password = Hash::make($password);
    }

    public function reset(Request $request)
    {
        // dd("check");
        $request->validate(self::VALIDATION_RULES, self::VALIDATION_MESSAGES);

        
        $user = $request->user();
        $pass = $request->get('current_password');
        $newPass = $request->get('new_password');
        if (!$this->assertPasswordEqual($user, $pass)) {
            return redirect()->back()->withErrors(['current_password' => 'Password yang anda masukkan tidak sesuai']);
        }

        try {
            $this->setUserPassword($user, $newPass);
            $user->save();
        } catch (\Throwable $th) {
            throw $th;
        }

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        Auth::logout();

        return redirect('/')->with('success',   true);
    }
}
