<?php

namespace App\Http\Controllers\api\admins;

use App\Http\Controllers\Controller;
use App\Models\admin\user_admin;
use Illuminate\Http\Request;
use Auth;


class AdminController extends Controller
{
		  public function index()
		    {
		        $user_details=user_admin::all();
		        return $user_details;
		    }


  

		public function usercheck(Request $request)	
			{
				return response()->json
		           ([
		               'success' =>  true,
		               'data' => Auth::guard('admins')->user(),
		               // 'token' => $token
		           ],200);
			}



	
}
