<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';

    protected $fillable =[
        'code', 'first_name', 'last_name', 'gender', 'date_of_birth', 'ID_card_no', 'phone', 'phone', 'phone', 'email', 'address', 'photo', 'department_id', 'position_id', 'joined_date', 'resigned_date', 'resigned_type', 'working_start_time', 'working_end_time', 'basic_salary', 'status', 'created_by', 'updated_by',
    ];

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function position(){
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function attendances(){
        return $this->hasMany(Attendance::class, 'employee_id', 'id');
    }

}
