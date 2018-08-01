@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">
          勤怠データ編集
        </div>
        <div class="panel-body">
          @if($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
                <li>{{$error}}</li>
              @endforeach
            </ul>
          </div>
          @endif
          {!!Form::open()!!}
            <div class="form-group">
              {!!form::label('出勤','出勤')!!}
              {!!form::time('出勤',Old('出勤',date('H:i',strtotime($attend->出勤))),['class'=>'form-control'])!!}
            </div>
            <div class="form-group">
              {!!Form::label('退勤','退勤')!!}
              {!!Form::time('退勤',Old('退勤',date('H:i',strtotime($attend->退勤))),['class'=>'form-control'])!!}
            </div>
            <div class="form-group">
              {!!Form::submit('Add Attend',['class'=>'btn btn-primary form-control'])!!}
            </div>
          {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
