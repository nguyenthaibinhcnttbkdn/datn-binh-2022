<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Employer;
use App\Models\Candidate;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $params = $request->only('email', 'password');

        if (Auth::attempt($params)) {
            $user = Auth::user();

            if ($user->role == 1) {
                $success['accessToken'] = $user->createToken('Personal Access Token', ['admin'])->accessToken;
                $success['id']          = Auth::id();
                $success['name']        = "Admin";
                $success['avatar']      = "";
                return $this->sendResult(true, "Đăng nhập thành công!", $success, 200);
            }

            if ($user->role == 2) {
                $active = Employer::where('employers.user_id', Auth::id())->get()->toArray();

                if ($active[0]['active'] == 1) {
                    $success['accessToken'] = $user->createToken('Personal Access Token', ['employer'])->accessToken;
                    $success['id']          = Auth::id();
                    $success['name']        = $active[0]['contact'];
                    $success['avatar']      = $active[0]['avatar'];
                    return $this->sendResult(true, "Đăng nhập thành công!", $success, 200);
                } else {
                    return $this->sendError(false, "Tài khoản chưa được kích hoạt !", [], 201);
                }
            }

            if ($user->role == 3) {
                $active = Candidate::where('candidates.user_id', Auth::id())->get()->toArray();
                if ($active[0]['active'] == 1) {
                    $success['accessToken'] = $user->createToken('Personal Access Token', ['candidate'])->accessToken;
                    $success['id']          = Auth::id();
                    $success['name']        = $active[0]['name'];
                    $success['avatar']      = $active[0]['avatar'];
                    return $this->sendResult(true, "Đăng nhập thành công!", $success, 200);
                } else {
                    return $this->sendError(false, "Tài khoản chưa được kích hoạt !", [], 201);
                }
            }

        } else {
            return $this->sendError(false, "Email hoặc mật khẩu không chính xác!", [], 400);
        }
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->sendResult(true, "Đăng xuất thành công", [], 200);
    }


}
