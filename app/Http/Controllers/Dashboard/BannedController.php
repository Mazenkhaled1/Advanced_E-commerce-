<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BannedController extends Controller
{
    public function unbanUser(Request  $request , $id) 
    {
        $user = User::find($id) ;
        if ($user->is_banned) {
            $user->is_banned = false; 
            $user->save();

            return $this->apiResponse($user , 'user unban Successfully' , 200) ; 
        }
        return $this->apiResponse($user , 'user is not banned' , 200) ; 

    }
}
