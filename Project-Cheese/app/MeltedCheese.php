<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeltedCheese extends Model
{
    protected $connection = "mysql2";
    protected $table = 'melted_cheese-episodes';
}
