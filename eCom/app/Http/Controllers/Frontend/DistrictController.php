<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    function index(){
        $district = Division::orderby('priority','asc')->get();
        return view('Frontend.pages.districts.index',compact('district'));
    }
    function create(){
        $divisions = Division::orderby('priority','asc')->get();
        return view('Frontend.pages.districts.create',compact('divisions'));
    }
    function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'division_id'=>'required'
        ],
            [
                'name.required'=>'please provide a district name',
                'division_id.required'=>'please provide a division Id'
            ]);

        $districts = new District();
        $districts->name = $request->name;
        $districts->division_id = $request->priority;
        $districts->save();

        session()->flash('success','A new Division Has added Successfully!!');
        return redirect()->route('Frontend.pages.districts');
    }

    function edit($id){
        $district = District::find($id);
        $divisions = Division::orderby('priority','asc')->get();

        if(!is_null($district)){
            return view('divisions.edit',compact('district','divisions'));
        }else{
            return redirect()->route('Frontend.pages.districts');
        }
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=>'required',
            'division_id'=>'required'
        ],
            [
                'name.required'=>'Please Provide a District Name',
                'division_id.required'=>'Please Provide a Division id'
            ]);

        $district = new District();
        $district->name = $request->name;
        $district->division_id = $request->division_id;
        $district->save();

        session()->flash('success',' District Has Updated Successfully!!');
        return redirect()->route('Frontend.pages.districts');

    }

    public function delete($id){
        $district = District::find($id);
        if(!is_null($district)){
            $district->delete();
        }

        session()->flash('success',' District Has Deleted Successfully!!');
        return redirect()->route('Frontend.pages.districts');
    }
}
