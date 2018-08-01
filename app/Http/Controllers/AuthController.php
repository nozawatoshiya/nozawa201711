<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Larafm;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    function login(){
      return view('auth.login');
    }
    function storeLogin(LoginRequest $request){

      $result=Larafm::Auth()->login($request->input());

      if($result->errorCode==0){
        return redirect('home');
      }else{
        $errors=array('Error'=>$result->message);
        return back()->withInput()->withErrors($errors);
      }
    }

    function logout(){
      Larafm::Auth()->logout();
      return redirect('login');
    }
}
