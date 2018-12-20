<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cheese extends Model
{
    protected $connection = "mysql2";
    protected $table = 'shared_cheese-shows';
}
