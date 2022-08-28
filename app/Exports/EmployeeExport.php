<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class EmployeeExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
       return [
         '#',
         'Code',
         'First Name',
         'Last Name',
         'Gender',
         'Department',
         'Position',
         'Phone',
         'Email',
         'Joined Date'
       ];
    }



    public function collection()
    {
        $records = Employee::leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                    ->leftJoin('positions', 'positions.id', '=', 'employees.position_id')
                    ->select('employees.*', 'departments.name AS department', 'positions.name AS position')->get();
        $result = array();
        foreach($records as $record){
           $result[] = array(
              'id'              =>$record->id,
              'first_name'      => $record->first_name,
              'last_name'       => $record->last_name,
              'gender'          => $record->gender,
              'department_id'   => $record->department,
              'position_id'     => $record->position,
              'phone'           => $record->age,
              'email'           => $record->email,
              'joined_date'     => $record->joined_date,
           );
        }

        return collect($result);

    }

}
