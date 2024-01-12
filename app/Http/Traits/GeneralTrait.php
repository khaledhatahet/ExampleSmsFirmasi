<?php

namespace App\Http\Traits;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

trait GeneralTrait{

    public function getCurrentRouteName(){
        $route = Route::current();
        $routeName = $route->getName();

        return $routeName;
    }

    public function returnError($msg)
    {
        return response()->json([
            'status' => false,
            'msg' => $msg
        ]);
    }


    public function returnSuccessMessage($msg = "")
    {
        return [
            'status' => true,
            'msg' => $msg
        ];
    }

    public function returnData($key, $value, $msg = "")
    {
        return response()->json([
            'status' => true,
            'msg' => $msg,
            $key => $value
        ]);
    }

    public function likeUnlikeMessage($value , $msg=""){
        return [
            'status' => true,
            'msg' => $msg,
            'like' => $value
        ];
    }

    public function authinticateUser(User $user=null): array{

        $routeName = $this->getCurrentRouteName(); // get current route name

        if($routeName != "user.login"){
            Auth::guard('user')->login($user); // we do not need this when user login with email because we use attemp function in controller
        }

        $user = Auth::guard('user')->user();
        $success['user'] = new UserResource($user);
        $success['token'] =  $user->createToken('MyApp',['user'])->accessToken;

        return $success;
    }

    public function deleteFiles($files = [],$folder){

        foreach($files as $file){
            Storage::disk('public')->delete('uploads/' . $folder . '/' . $file);
        }
    }

    public function updateFiles(array $files, array $images, string $folder): array{

            $newImages = [];
            foreach($files as $key => $file ){
                if($file  && !is_string($file) ){
                    $img = $images[$key];
                    $this->deleteFiles([$img] , $folder);
                    $img= time().'_'.Str::random(10).$file->hashname();
                    $file->storeAs('public/uploads/' . $folder .'/',$img);
                }else{
                    $img = $images[$key];
                }

                $newImages[$key] = $img;
            }
            return $newImages;
    }
}
?>
