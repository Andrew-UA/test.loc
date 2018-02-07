<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Position;

class Employee extends Model
{
    protected $fillable = ['first_name', 'second_name', 'features', 'salary', 'position_id'];
    public $timestamps = false;

    public function position () {
       return $this->belongsTo(Position::class, 'position_id');
    }
    //
}
