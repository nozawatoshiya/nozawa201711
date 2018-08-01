<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Larafm;

class UserModel extends Larafm
{
    public function __construct(){
      Larafm::setLayout('ユーザー');
      return $this;
    }
}
