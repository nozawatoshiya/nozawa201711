@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                  ユーザーリスト
                </div>
                <div class="panel-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>アカウント</th>
                        <th>氏名</th>
                        <th>権限</th>
                        <th>ステータス</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($users as $user)
                      <tr>
                        <th>{{$user->RecId}}</th>
                        <th>{{$user->アカウント}}</th>
                        <th>{{$user->氏名}}</th>
                        <th>{{$user->権限}}</th>
                        <th>
                          <input type="checkbox" data-toggle="toggle" name="" value="" onchange="del({{$user->RecId}})"
                                  <?php if($user->フラグ_削除==""){echo 'checked';}?>
                                  data-on="有効" data-off="無効" data-onstyle="primary" data-size="mini">
                        </th>
                      </tr>
                    </tbody>
                    @endforeach
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  function del(id){

    var hostUrl="{{url("api/deluser")}}";
    $.ajax({
      url:hostUrl,
      type:'POST',
      dataType:'json',
      data:{
        'id':id,
        'user':'{{Larafm::Auth()->user()->アカウント}}'
      },
      timeout:10000,
    }).done(function(data){
      if(data['result']!='true'){
        alert('失敗す');
      }
    }).fail(function(XMLHttpRequest,textStatus,errorThrown){
      alert('アカウントの削除処理に失敗しました。画面を更新してください');
    })
  }

</script>
@endsection
