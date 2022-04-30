<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;
use function redirect;
use function session;
use function view;

class DivisionController extends Controller
{
    function index(){
        $divisions = Division::orderby('priority','asc')->get();
        return view('Frontend.pages.divisions.index',compact('divisions'));
    }
    function create(){
        $divisions = Division::orderby('priority','asc')->get();
        return view('Frontend.pages.Checkout',compact('divisions'));
    }
    function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'priority'=>'required'
        ],
            [
                'name.required'=>'please provide a division name',
                'priority.required'=>'please provide a division priority'
            ]);

        $division = new Division();
        $division->name = $request->name;
        $division->priority = $request->priority;
        $division->save();

        session()->flash('success','A new Division Has added Successfully!!');
        return redirect()->route('admin.divisions');
    }

    function edit($id){
        $division = Division::find($id);

        if(!is_null($division)){
            return view('divisions.edit',compact('division'));
        }else{
            return redirect()->route('admin.divisions');
        }
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=>'required',
            'priority'=>'required'
        ],
            [
                'name.required'=>'Please Provide a Division Name',
                'priority.required'=>'Please Provide a Division Priority'
            ]);

        $division = new Division();
        $division->name = $request->name;
        $division->priority = $request->priority;
        $division->save();

        session()->flash('success',' Division Has Updated Successfully!!');
        return redirect()->route('admin.divisions');

    }

    public function delete($id){
        $division = Division::find($id);
        if(!is_null($division)){
            $division->delete();
        }

        session()->flash('success',' Division Has Deleted Successfully!!');
        return redirect()->route('admin.divisions');
    }
}
