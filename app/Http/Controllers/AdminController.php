<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use App\UserModel;
use Larafm;

class AdminController extends Controller
{
    public function __construct(){
      new UserModel();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=UserModel::get()->data;
        return view('admin.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rules=[
          'id'=>'required|integer',
          'user'=>'required'
        ];
        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
          $data['message']='Validate error';
          $data['result']='fails';
          return $data;
        }
        $user=UserModel::where('アカウント',$request['user'])->first();
        if($user->data->権限!='管理者'){
          $data['message']='Permission error';
          $data['result']='fails';
          return $data;
        }

        $delUser=UserModel::find($request['id']);
        if($delUser->errorCode!=0){
          $data['message']='user is not found';
          $data['result']='fails';
          return response()->json($data);
        }else{
          $delUser=$delUser->data;
        }
        if($delUser->フラグ_削除==''){
          $updata=['フラグ_削除'=>'削除'];
        }else{
          $updata=['フラグ_削除'=>''];
        }
        $result=UserModel::find($request['id'])->update($updata);

        if($result->errorCode!=0){
          $data['message']='Update error';
          $data['result']='fails';
          return response()->json($data);
        }
        $currentStatus=$result->data->フラグ_削除;
        $data=[
          'current'=>$currentStatus,
          'result'=>'true',
          'id'=>$request['id'],
        ];
        return response()->json($data);
        /*
        $jsonCollect = collect();
        $jsonCollect->put('id',$request['id']);
        $json = $jsonCollect->toJson();
        return $json;
        */
    }
}
