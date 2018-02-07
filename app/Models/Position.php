<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Position extends Model
{
    protected $fillable = ['name', 'description'];
    public $timestamps = false;

    public function employees() {
       return $this->hasMany(Employee::class);
    }
    //
}
