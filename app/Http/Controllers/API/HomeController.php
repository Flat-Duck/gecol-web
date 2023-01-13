<?php

namespace App\Http\Controllers\API;

use App\Student;

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
