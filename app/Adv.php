<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adv extends Model
{
    //
    protected $table = 'advs';
    protected $fillable = ['name', 'Attachments', 'price','location','descrioption','user_id','category_id'];


}
