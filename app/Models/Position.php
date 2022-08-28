<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $table = 'positions';

    protected $fillable = [
        'department_id', 'name', 'description',
    ];

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function employees(){
        return $this->hasMany(Employee::class, 'position_id', 'id');
    }
}
