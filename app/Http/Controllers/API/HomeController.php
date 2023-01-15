<?php

namespace App\Http\Controllers\API;

use App\Balance;
use App\Reading;

class HomeController extends ApiController
{
    public function notices()
    {
        $notices = request()->user()->counter->notices;
        

        return $this->sendResponse("Notices Loaded", $notices);
    }

    public function readings()
    {
        $readings = request()->user()->counter->readings;
        

        return $this->sendResponse("Readings Loaded", $readings);
    }

    public function pay(Reading $reading)
    { 
        if($reading->is_paid){
            return $this->sendResponse("مدفوعة مسبقا", $reading);    
        }
        $bank = Balance::find(1);
        $user = request()->user();
        $read_val = $reading->value * 0.14;
        $balance = $user->balance;
        
        if(($read_val) > $balance->amount){
            return $this->sendError("رصيدك غير كافي", $balance,200);    
        }
        
        $user->balance->amount -= $read_val;
        $user->balance->save();
        $bank->amount += $read_val;
        $bank->save();        
        $reading->is_paid = true;
        $reading->save();
        
        return $this->sendResponse("تم الدفع بنجاح", $balance);
    }

    public function main()
    {
        $user = request()->user()->main();

        return $this->sendResponse("Main data Loaded", $user);
    }
    
    public function updatePassword()
    {
        $user = request()->user();
        $user->password = bcrypt(request()->password);
        $user->save();

        return $this->sendResponse("password Changed Successful", $user);
    }
}
