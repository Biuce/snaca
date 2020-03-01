<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\Api\UserResource;
use App\Jobs\Api\SaveLastTokenJob;
use Illuminate\Http\Request;
use App\Model\Api\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class UserController extends Controller
{
    /**
     * 返回用户列表
     * @return mixed
     */
    public function index()
    {
        $users = User::paginate(3);
        return UserResource::collection($users);
    }

    /**
     * 返回单一用户信息
     * @param User $user
     * @return User
     */
    public function show(User $user)
    {
        3 / 0;
        return $this->success(new UserResource($user));
    }

    /**
     * 用户注册
     * @param UserRequest $request
     * @return string
     *
     */
    public function store(UserRequest $request)
    {
        User::create($request->all());
        return $this->setStatusCode(201)->success('用户注册成功');
    }

    /**
     * 用户登录
     * @param Request $request
     * @return string
     */
    public function login(Request $request)
    {
        $token = Auth::guard('api')->attempt(['name' => $request->name, 'password' => $request->password]);
        if ($token) {
//            $user = Auth::user();
//            dd($user);
//            if ($user->last_token) {
//                try {
//                    Auth::setToken($user->last_token)->invalidate();
//                } catch (TokenExpiredException $e) {
//                    //因为让一个过期的token再失效，会抛出异常，所以我们捕捉异常，不需要做任何处理
//                }
//            }
//
//            // 分发job
//            SaveLastTokenJob::dispatch($user, $token);

            return $this->setStatusCode(201)->success(['token' => 'bearer ' . $token]);
        }
        return $this->failed('账号或密码错误', 400);
    }

    /**
     * 用户退出
     * @return mixed
     */
    public function logout()
    {
        Auth::guard('api')->logout();
        return $this->success('退出成功...');
    }

    /**
     * 返回当前登录用户信息
     * @return mixed
     */
    public function info()
    {
        $user = Auth::guard('api')->user();
        return $this->success(new UserResource($user));
    }
}
