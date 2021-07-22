<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name','email','logo','website'];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function employees(){
        return $this->hasMany(Employee::class);
     }
}