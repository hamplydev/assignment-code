<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = "attendances";

    protected $fillable = [
        'employee_id', 'date', 'time_in', 'time_out',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
