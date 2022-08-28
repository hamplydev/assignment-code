<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';

    protected $fillable = [
        'name', 'description', 
    ];

    public function positions(){
        return $this->hasMany(Position::class, 'dempartment_id', 'id');
    }

    public function employees(){
        return $this->hasMany(Employee::class, 'dempartment_id', 'id');
    }

    public static function getDepartment(){
        $dept_data = DB::table('departments')
                    ->select('name','description')
                    ->get();
        return $dept_data;
    }
}
