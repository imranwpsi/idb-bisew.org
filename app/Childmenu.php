<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Childmenu extends Model
{
    public function Menubar()
    {
        return $this->belongsTo('App\Menubar');
    }
}
