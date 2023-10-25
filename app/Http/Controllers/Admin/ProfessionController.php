<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Http\Request;
use App\Models\Profession;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProfessionController extends Controller
{
    public function index (Request $request) {

        $professions = Profession::orderBy('created_at', 'desc')->paginate(10);
        // Handle load more
        if ($request->ajax()) {
            $view = view('admin.profession.data', compact('professions'))->render();
            return response()->json(['html' => $view]);
        }
       
        return view('admin.profession.list', compact('professions'));
    }

    public function create (Request $request) {

        
        $dataProfession = [
            'name' => $request->name,
            'slug' => Str::of($request->name)->slug('-'),
            'parent_profession' => $request->parent_profession ?? [],
            // 'created_by' => Auth::user()->_id,
        ];
        $validation = Validator::make($dataProfession, [
            'name' => ['required',Rule::unique('professions')->whereNull('deleted_at')],
        ]);

        if($validation->fails()) {
            return response()->json(['errors'=> $validation->errors()]);
        } 
        $data = Profession::create($dataProfession);
        
        if ($data->parent_profession == []) {
            $data2 = [];
        }else if($data->parent_profession !== []){
           
            foreach ($data->parent_profession as $parent) {
            
                $data2[] = Profession::where('_id', $parent)->pluck('name');
            }
        }

       return response()->json(['status' => true, 'message' => 'You create successfully.','data' => $data,'data2' => $data2]);

    }

    public function edit($id) {

        $data = Profession::find($id);
        $data2 = Profession::all();
    
        return response()->json(['status' => true, 'message' => '', 'data' => $data, 'data2' => $data2, 'url' => route('profession.update', $id)]);
    }
   

    public function update(Request $request, $id)  {

        $dataProfession = [
            'name' => $request->name,
            'slug' => Str::of($request->name)->slug('-'),
            'parent_profession' => $request->parent_profession ?? [],
            // 'created_by' => Auth::user()->_id,
        ];

        $validation = Validator::make($dataProfession, [
            'name' => ['required'],
        ]);

        if($validation->fails()) {
            return response()->json(['errors'=> $validation->errors()]);
        } 

        Profession::find($id)->update($dataProfession);
        $data = Profession::find($id);
        if ($data->parent_profession == []) {
            $data2 = [];
        }else if($data->parent_profession !== []){
           
            foreach ($data->parent_profession as $parent) {
            
                $data2[] = Profession::where('_id', $parent)->pluck('name');
            }
        }

      
        return response()->json(['status' => true, 'message' => 'You update successfully.', 'data' => $data, 'data2' =>$data2, 'id' =>$id]);
    }

    public function destroy($id) {
        $professions = Profession::all();

        foreach($professions as $pr) {
            if ($pr->parent_profession == []) {
                Profession::destroy($id);
            }
            foreach($pr->parent_profession as $parent) {
                if($id == $parent) {
                    Profession::where('parent_profession', $id)->pull('parent_profession',$id); 
                   
                }else{
                    Profession::destroy($id);
                }
            }
        }
        return response()->json(['status' =>true,'message' =>  'Profession delete successfully']);
    }
}
