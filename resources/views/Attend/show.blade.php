@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">
          勤怠打刻データ
        </div>
        <div class="panel-body">
          <table class='table'>
            <thead>
              <tr>
                <th>#</th>
                <th>日付</th>
                <th>曜日</th>
                <th>区分</th>
                <th>出勤</th>
                <th>休憩</th>
                <th>退勤</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>{{$attend->RecId}}</th>
                <th>{{$attend->日付}}</th>
                <th>{{$attend->曜日}}</th>
                <th>{{$attend->区分}}</th>
                <th>{{date('H:i',strtotime($attend->出勤))}}</th>
                <th>{{date('H:i',strtotime($attend->休憩))}}</th>
                <th>{{date('H:i',strtotime($attend->退勤))}}</th>
              </tr>
            </tbody>
          </table>
          <a href="{{url('attend')}}" class="btn btn-primary">一覧</a>
          <a href="{{url('attend/'.$attend->RecId.'/edit')}}" class="btn btn-success">編集</a>
          <a href="{{url('attend/'.$attend->RecId.'/delete')}}" class="btn btn-success">削除</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
