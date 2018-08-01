@extends('layouts.app')
@section('content')
<!-- Copyright 2013 Nick Rassadin <nick.rassadin@gmail.com>
Content is licensed under CC BY-NC-SA 3.0 -->

<style>
/* For showing in codepen */
body {
 background: #27292A;
 padding-top:1em;
 font-size:2em;
 text-align:center;
}
</style>

<!-- Load GMT time with external CSS -->
<link href="http://tezla.ru/rassadin/wall-clock-demo/" rel="stylesheet" type="text/css" />

<div id="clock">
	<div id="a">
		<div id="b">
			<div id="c">
				<div id="d">
					<div id="sh">
						<div class="hh">
							<div class="h"></div>
						</div>
						<div class="mm">
							<div class="m"></div>
							<div class="mr"></div>
						</div>
						<div class="ss">
							<div class="s"></div>
						</div>
					</div>
					<div id="ii">
					<b><i></i><i></i><i></i><i></i></b>
					<b><i></i><i></i><i></i><i></i></b>
					<b><i></i><i></i><i></i><i></i></b>
					<b><i></i><i></i><i></i><i></i></b>
					<b><i></i><i></i><i></i><i></i></b>
					<b><i></i><i></i><i></i><i></i></b>
					</div>
					<div id="e">
						<div id="f">
							<u>12<u>1<u>2<u>3</u>4</u>5</u></u>
						</div>
						<div id="g">
							<u><u>11<u>10<u>9</u>8</u>7</u>6</u>
						</div>
						<div id="q"><a href="" style="position:relative;z-index:1000;color:#222;text-decoration:none;">quartz</a></div>
					</div>
					<div class="hh">
						<div class="h"></div>
					</div>
					<div class="mm">
						<div class="m"></div>
						<div class="mr"></div>
					</div>
					<div class="ss">
						<div class="s"></div>
						<div class="sr"></div>
					</div>
					<div id="k"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">
          勤怠打刻
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
          @if($today->errorCode==0 and $today->data->退勤=="")
          {{--レコードがあり、かつ退勤されていない場合--}}
          {!!Form::open()!!}
            <div class="text-center">
              <h3>出勤：{{$today->data->出勤}}</h3>
            </div>
            <div class="form-group">
              {!!Form::submit('退勤',['class'=>'btn btn-primary form-control','name'=>'勤怠'])!!}
            </div>
          {!!Form::close()!!}
          @elseif($today->errorCode==0)
          {{--出勤も退勤もしている場合--}}
          <div class="text-center">
            <h3>出勤:{{$today->data->出勤}}</h3>
            <h3>退勤:{{$today->data->退勤}}</h3>
          </div>
          @else
          {{--レコードが無い場合--}}
          {!!Form::open()!!}
          <div class="form-group">
            {!!Form::submit('出勤',['class'=>'btn btn-primary form-control','name'=>'勤怠'])!!}
          </div>
          {!!Form::close()!!}
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
