<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['firstname','lastname','email','phone','compnany_id'];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    protected $with = ['company'];

    public function company(){
        return $this->belongsTo(Company::class);
    }
}