<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menubar extends Model
{
    public function Childmenu()
    {
        return $this->hasMany('App\Childmenu','parent_id', 'id');
    }
}
