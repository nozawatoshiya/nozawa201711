@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      @if(Session::has('messages'))
        @foreach(session('messages') as $key=>$message)
          <div class="alert alert-{{$key}}" id="save">
            {{$message}}
          </div>
        @endforeach
      @endif
      <div class="panel panel-primary">
        <div class="panel-heading">
          勤怠打刻データリスト
        </div>
        <div class="panel-body">
          @php
            for($i=date('Y'); $i >=2015; $i--){
              $year[$i]=$i;
            }
            for($i=12; $i>=1; $i--){
              $month[sprintf('%02d',$i)]=sprintf('%02d',$i);
            }
          @endphp
          {!!Form::open()!!}
            {{Form::select('y',$year)}}
            年
            {{Form::select('m',$month)}}
            月
            {{Form::submit('移動')}}
          {!!Form::close()!!}
          @if($attends->errorCode!=0)
            <h2>{{$attends->errorCode}}:{{$attends->message}}</h2>
          @else
          <table class='table'>
            <thead>
              <tr>
                <th>#</th>
                <th>日付</th>
                <th>曜日</th>
                <th>出勤</th>
                <th>退勤</th>
                <th>Detail</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach($attends->data as $attend)
              <tr>
                <th>{{$attend->RecId}}</th>
                <th>{{$attend->日付}}</th>
                <th>{{$attend->曜日}}</th>
                <th>{{$attend->出勤}}</th>
                <th>{{$attend->退勤}}</th>
                <th><a href="{{url('attend/'.$attend->RecId)}}" class="btn btn-primary">詳細</a></th>
                <th><a href="{{url('attend/'.$attend->RecId).'/edit'}}" class="btn btn-success">編集</a></th>
                <th>
                  {!!Form::open(['url'=>url('attend/'.$attend->RecId.'/delete')])!!}
                    {{Form::submit('削除',["class"=>"btn btn-danger delete"])}}
                  {!!Form::close()!!}
                </th>
              </tr>
              @endforeach
            </tbody>
          </table>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(function(){
    $('.delete').on('click',function(){
      if(window.confirm('消します。')){
        location.href = $(this).attr('href');
      }else{
        return false;
      }
    });
  });
  $(function(){
    $('#save').fadeOut(3000);
  });
</script>
@endsection
