<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserLoginRequest;

class AuthenticationController extends Controller
{
    use GeneralTrait;

     /**
     * @OA\Post(
     *     path="/api/registerUser",
     *     summary="Register New user",
     *     tags={"Authentication"},
     *  @OA\Parameter(
     *    name="name",
     *         description="User name",
     *         in="query",
     *         required=true,
     *         example="khaled"
     *     ),
     *  @OA\Parameter(
     *         name="email",
     *         description="User email",
     *         in="query",
     *         required=true,
     *         example="khaled.hatahet@gmail.com"
     *     ),
     *  @OA\Parameter(
     *         name="password",
     *         description="User Password",
     *         in="query",
     *         required=true,
     *         example="Ales12234"
     *     ),
     *  @OA\Parameter(
     *         name="rePassword",
     *         description="re Password",
     *         in="query",
     *         required=true,
     *         example="Ales12234"
     *     ),
     * @OA\Response(
     *         response="200",
     *         description="data added successfully"
     *     )
     * )
     */

    public function registerUser(StoreUserRequest $request){
        try{

            $user = User::create([
                'name' => $request->name ,
                'email' => $request->email ,
                'password' => Hash::make($request->password) ,
            ]);

            if($user){
                return $this->returnSuccessMessage(__('general.userRegisteredSuccessfully'));
            }else{
                return $this->returnError(__('general.errorWhenRegisteringUser'));
            }

        } catch (\Throwable $th) {
            return $this->returnError(__('general.errorWhenRegisteringUser'));
        }

    }

     /**
     * @OA\Post(
     *     path="/api/loginUser",
     *     summary="Login User",
     *     tags={"Authentication"},
     *  @OA\Parameter(
     *         name="email",
     *         description="User email",
     *         in="query",
     *         required=true,
     *         example="khaled.hatahet@gmail.com"
     *     ),
     *  @OA\Parameter(
     *         name="password",
     *         description="User Password",
     *         in="query",
     *         required=true,
     *         example="Ales12234"
     *     ),
     * @OA\Response(
     *         response="200",
     *         description="data added successfully"
     *     )
     * )
     */

    public function loginUser(UserLoginRequest $request){
        try{

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password ])){

                $token = auth()->user()->createToken('token')->accessToken;

                return $this->returnData("data",$token,__('general.loginSuccessfully'));
            }
            else{
                return $this->returnError(__('general.incorrectLoginData'));
            }

        } catch (\Throwable $th) {
            return $th;
            return $this->returnError(__('general.errorWhenLoginUser'));
        }
    }
}
