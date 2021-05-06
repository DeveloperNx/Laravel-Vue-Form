<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;
// use Illuminate\Http\Request;

class RegisterController extends Controller
{

	public function list(){
		$userData=Register::paginate(10);
		return response()->json($userData);

		// $arrUserData=[];
		// foreach($userData as $ud){	
		// 	$varUserData=[
		// 		'id'=>$ud->id,
		// 		'firstname'=>$ud->firstname,
		// 		'lastname'=>$ud->lastname,
		// 		'address'=>$ud->address,
		// 		'contactnumber'=>$ud->contactnumber,
		// 		'email'=>$ud->email,
		// 		'gender'=>$ud->gender,
		// 	];

		// 	array_push($arrUserData,$varUserData);
		// }

		// return response()->json([
		// 	'suceess'=>config('constants.validResponse.success'),
		// 	'message'=>'Got user data successfully',
		// 	'data'=>$arrUserData,
		// ],config('constants.validResponse.statusCode'));
	}

   	public function add(Request $request){
   			Register::create([
   				'firstname'=>$request->firstname,
   				'lastname'=>$request->lastname,
   				'address'=>$request->address,
   				'contactnumber'=>$request->contactnumber,
   				'email'=>$request->email,
   				'gender'=>$request->gender,
   			]);
   			 return response()->json('The user successfully registered');
   	}

   	public function edit($id){
   		$userData=Register::find($id);
   		return response()->json($userData);
   	}

   	public function update(Request $request,$id)
	{
			Register::where('id','=',$id)->update([
				'firstname'=>$request->firstname,
   				'lastname'=>$request->lastname,
   				'address'=>$request->address,
   				'contactnumber'=>$request->contactnumber,
   				'email'=>$request->email,
   				'gender'=>$request->gender,
			]);
			return response()->json('The user details successfully updated');
	}

   public function delete($id){
   		Register::where('id','=',$id)->delete();
   }
}

