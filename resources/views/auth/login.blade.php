@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                  {!!Form::open()!!}
                    <div class="col-md-6 col-md-offset-3">
                      <div class="form-group {{ $errors->has('アカウント')? 'has-error':''}}">
                        {!!Form::label('アカウント','Account')!!}
                        {!!Form::text('アカウント',old('アカウント'),['class'=>'form-control'])!!}
                          @if($errors->has('アカウント'))
                            <span class="help-block">
                              <strong>{{$errors->first('アカウント')}}</strong>
                            </span>
                          @endif
                      </div>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                      <div class="form-group {{ $errors->has('パスワード')? 'has-error':''}}">
                        {!!Form::label('パスワード','パスワード')!!}
                        {!!Form::password('パスワード',['class'=>'form-control'])!!}
                          @if($errors->has('パスワード'))
                            <span class="help-block">
                              <strong>{{$errors->first('パスワード')}}</strong>
                            </span>
                          @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-8 col-md-offset-4">
                        {!!Form::submit('Login',['class'=>'btn btn-primary'])!!}
                      </div>
                    </div>
                  {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
