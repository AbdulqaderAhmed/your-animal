<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class testController extends Controller
{
    public function register(Request $req){
    	$cred = $req->validate([
    		"name" => "required|string",
    		"email" => "required|unique:users",
    		"password" => "required|confirmed",
    	]);
    	
    	$cred["password"] = bcrypt($req->password);
    	
    	$user = User::create($cred);
    	$accessToken = 
    		$user->createToken("userToken")->accessToken;
    		
    	return response(["user"=>$user, "accessToken"=>$accessToken]);
    }
    
    public function login(Request $req){
    	$cred = $req->validate([
    		"email" => "required",
    		"password" => "required",
    	]);
    	
    	if(!auth()->attempt($cred)){
    		return response(["message"=>"invalid credential"]);
    	}
    	
    	$accessToken = auth()->user()
    			->createToken("addToken")->accessToken;
    	
    	return response(["user"=>auth()->user(), "accessToken"=>$accessToken]);
    	
    }
    
    public function userInfo(){
    	$user = auth()->user();
    	return response(["user" => $user]);
    }
}