<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

use Excel;
use App\Exports\DepartmentExport;

class DepartmentController extends Controller
{
    //
    public function index()
    {
        /*$department = Department::all();
        return view('department.index', compact('department'));*/

        $department = Department::latest()->paginate(5);
        return view('department.index',compact('department'))
                ->with('i',(request()->input('page',1)-1)*5);
    }

    public function create(){
        return view('department.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $department = new Department;
        $department->name           = $request->input('name');
        $department->description    = $request->input('description');
        $result     = $department->save();        
        if($result){
            return redirect()->back()->with('success','Department added successfully'); 
        }else{
            return redirect()->back()->with('error','Something wrong! Try again later.'); 
        }
    }
    public function show($id)
    {
        $department = Department::find($id);
        return view('department.create', compact('department'));
    }   
    public function edit($id)
    {
        $department = Department::find($id);
        return view('department.create', compact('department'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $department = Department::find($id);
        $department->name           = $request->input('name');
        $department->description    = $request->input('description');
        $result     = $department->update();        
        if($result){
            return redirect()->route('department.index')->with('success','Department updated successfully');
        }else{
            return redirect()->back()->with('error','Something wrong! Try again later.'); 
        }

    } 
    public function destroy($id)
    {
        /*$department = Department::find($id);
        $department->delete();
        return redirect()->back()->with('status','Department deleted successfully.');*/

        $department = Department::find($id);
        $department->delete();
        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }


    public function exportToExcel(){
        return Excel::download(new DepartmentExport, 'department.xlsx');
    }

    public function exportToCSV(){
        return Excel::download(new DepartmentExport, 'department.csv');
    }
}
