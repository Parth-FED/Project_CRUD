<?php

namespace App\Http\Controllers;

use App\Models\Employree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Laravel\Sail\Console\PublishCommand;

class EmployeeController extends Controller
{
    public function index() {

        $employee = Employree::orderBy('id','DESC')->paginate(10);

        return view('employee.list',['employee' => $employee]);
    }

    public function create() {
        return view('employee.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'image' => 'sometimes|image:gif,png,jpeg,jpg'
        ]);

        if ( $validator->passes() ) {
            //save data here

            $employ = new Employree();
            $employ->name = $request->name;
            $employ->email = $request->email;
            $employ->address = $request->address;
            $employ->save();

            //upload image

            if($request->image) {
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().'.'.$ext;
                $request->image->move(public_path().'/uploads/employees/',$newFileName); //This will save file in folder

                $employ->image = $newFileName;
                $employ->save();
            }


            $request->Session()->flash('success','Employee added successfully.');

            return redirect()->route('employees.index');


        } else {
            //return with error
            return redirect()->route('employees.create')->withErrors($validator)->withInput();
        }

    }

    public function edit($id){

        $employ = Employree::findOrFail($id);


        return view('employee.edit',['employ'=>$employ]);

    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'image' => 'sometimes|image:gif,png,jpeg,jpg'
        ]);

        if ( $validator->passes() ) {
            //save data here

            $employ = Employree::find($id);
            $employ->name = $request->name;
            $employ->email = $request->email;
            $employ->address = $request->address;
            $employ->save();

            //upload image

            if($request->image) {
                $OldImage = $employ->image;
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().'.'.$ext;
                $request->image->move(public_path().'/uploads/employees/',$newFileName); //This will save file in folder

                $employ->image = $newFileName;
                $employ->save();

                File::delete(public_path().'/uploads/employees/'.$OldImage);
            }


            $request->Session()->flash('success','Employee Updated successfully.');

            return redirect()->route('employees.index');


        } else {
            //return with error
            return redirect()->route('employees.edit',$id)->withErrors($validator)->withInput();
        }

    }

    public function destroy($id, Request $request){
        $employ = Employree::findOrFail($id);

        File::delete(public_path().'/uploads/employees/'.$employ->image);

        $employ->delete();

        $request->session()->flash('success','Employee deleted successfully.');
        return redirect()->route('employees.index');

    }

}

