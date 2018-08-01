<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AttendRequest;
use App\Attend;
use Larafm;

class AttendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(){
       new Attend;
     }


    public function index(request $request)
    {
        $date=$request->query();

        if($date and $date['m'] and $date['y'] and strtotime($date['y'].$date['m'].'01')){
          $m=$date['m'];
          $y=$date['y'];
        }else{
          $m=date('m');
          $y=date('y');
        }

        $account=Larafm::Auth()->user()->アカウント;
        $attends=Attend::where('日付',$m.'/*/'.$y)->
                         orderBy('日付')->
                         where('ユーザーid','=',$account)->
                         get();
        //$attends=$attends->data;

        return view('Attend.index',compact('attends'));
    }
    public function postindex(request $request){
      if($request and $request['m'] and $request['y'] and strtotime($request['y'].$request['m'].'01')){
        $m=$request['m'];
        $y=$request['y'];
      }else{
        $m=date['m'];
        $y=date['Y'];
      }
      return redirect('/attend?m='.$m.'&y='.$y);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account=Larafm::Auth()->user()->アカウント;
        $today=Attend::whereDate('日付',date('Y/m/d'))->
                       where('ユーザーid','=',$account)->
                       first();
        return view('Attend.create',compact('today'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        switch($request['勤怠']){
          case '出勤':
            $data=[
              '出勤'=>$request['出勤'],
              '退勤'=>$request['退勤'],
              'ユーザーid'=>Larafm::Auth()->user()->アカウント,
              '日付'=>date('Y/m/d'),
            ];

            $result=Attend::create($data);
            break;
          case '退勤':
            $today=Attend::whereDate('日付',date('Y/m/d'))->
                           where('ユーザーid','=',Larafm::Auth()->user()->アカウント)->
                           first();
            $data=['退勤'=>date('H:i')];
            $result=$today->update($data);
            break;
          default:
            return redirect()->back();
            break;
        }
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attend=Attend::find($id);
        $attend=$attend->data;
        return view('Attend.show',compact('attend'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attend=Attend::find($id);
        $attend=$attend->data;
        return view('Attend.edit',compact('attend'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttendRequest $request, $id)
    {
        $data=[
          '出勤'=>$request['出勤'],
          '退勤'=>$request['退勤'],
          '区分'=>'通常',
        ];
        $result=Larafm::find($id)->update($data);
        return redirect('attend/'.$result->data->RecId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result=Larafm::find($id)->delete();
        if($result->errorCode==0){
          $message=["info"=>'レコードが削除されました。'];
        }else{
          $message=['error'=>$result->message];
        }
        return redirect()->back()->with('messages',$message);
    }
}
