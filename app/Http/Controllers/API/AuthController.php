<?php

namespace App\Http\Controllers\API;

use App\Balance;
use App\Consumer;
use App\Notifications\VerificationPin;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends ApiController
{
    public function login(Request $request)
    {
        if (!Auth::guard()->attempt($request->only(['n_id','password']))) {
            return $this->sendError('not Authrized', 'Invalid login Data', 200);
        }
        
        $token = Auth::guard()->user()->createToken('AuthToken')->accessToken;
        return $this->sendResponse("Login Succefull", ['accessToken' => $token]);
    }

    public function register(Request $request)
    {
        
        $validator = Validator::make($request->all(), 
            Consumer::validationRules()
        );
        
        if ($validator->fails()) {            
            return $this->sendError('Bad data', $validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $validator = Validator::make($request->all(), 
        User::validationRules()
    );
    
    if ($validator->fails()) {            
        return $this->sendError('Bad data', $validator->messages(), Response::HTTP_BAD_REQUEST);
    }

        $pinCode = mt_rand(111111,999999);
        $consumer = Consumer::create(request()->only(['name','n_id','office_id']));
        $balance = Balance::create(['consumer_id' => $consumer->id ,'amount'=> 0]);
        $user = User::firstOrCreate([
            'name'=> request()->name,
            'email'=> request()->email,
            'n_id'=> request()->n_id,
            'remember_token' => $pinCode,
            'password'=> bcrypt(request()->password)
            ]);            
        $user->notify(new VerificationPin($pinCode, $user->email, $user->name));
        return $this->sendResponse("Registred Succefully", ['user' => $user]);
    }

    public function verify(Request $request)
    {
        $user = User::where('email',$request->email)->get()->first();
        if($user){
            if($user->remember_token == $request->pin){
                $user->remember_token = null;
                $user->email_verified_at = Carbon::now();
                $user->save();            
                $token = $user->createToken('AuthToken')->accessToken;
                return $this->sendResponse("Login Succefull", ['accessToken' => $token]);
            
            }else{
                return $this->sendError('not found', 'User not Found', 404);
            }
        }else{
            return $this->sendError('not found', 'User not Found', 404);
        }        
    }

}
