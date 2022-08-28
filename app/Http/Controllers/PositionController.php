<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Department;

class PositionController extends Controller
{
    //
    public function index()
    {
        /*$position = Department::all();
        return view('position.index', compact('position'));*/

        $position = Position::latest()->paginate(5);
        return view('position.index',compact('position'))
                ->with('i',(request()->input('page',1)-1)*5);
    }

    public function create(){
        // $department = Department::all()->orderBy('name', 'asc')->lists('name','id');
        $department = Department::orderBy('name', 'asc')->get();
        return view('position.create', compact('department'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $position = new Position;
        $position->name           = $request->input('name');
        $position->description    = $request->input('description');
        $position->department_id  = $request->input('department_id');
        $result     = $position->save();        
        if($result){
            return redirect()->back()->with('success','Data added successfully'); 
        }else{
            return redirect()->back()->with('error','Something wrong! Try again later.'); 
        }
    }
    public function show($id)
    {
        $position = Position::find($id);
        return view('position.create', compact('position'));
    }   
    public function edit($id)
    {
        $department = Department::orderBy('name', 'asc')->get();
        $position = Position::find($id);
        return view('position.create', compact('position','department'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $position = Position::find($id);
        $position->name           = $request->input('name');
        $position->description    = $request->input('description');
        $position->department_id  = $request->input('department_id');
        $result     = $position->update();        
        if($result){
            // return redirect()->back()->with('success','Position updated successfully'); 
            return redirect()->route('position.index')->with('success','Data updated successfully');
        }else{
            return redirect()->back()->with('error','Something wrong! Try again later.'); 
        }

    } 
    public function destroy($id)
    {
        /*$position = Position::find($id);
        $position->delete();
        return redirect()->back()->with('status','Position deleted successfully.');*/

        $position = Position::find($id);
        $position->delete();
        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }
}
