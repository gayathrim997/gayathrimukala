<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Http\Resources\CreateDepartmentResource;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_depatments = Department::all();
        return [
            "message" => 'All Departments',
            "departments" => CreateDepartmentResource::collection($all_depatments)
        ];
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateDepartmentRequest $request)
    {
        $department = Department::create([
            'name' => $request->name,
            'description'=>$request->description,
            'added_by' =>$request->added_by,
            'status' =>$request->status
        ]);

        // $all_depatments = Department::all();
        return [
            "message" => 'department created ',
            'departments' =>new CreateDepartmentResource($department)
        ];

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::whereId($id)->first();

        return [
            new CreateDepartmentResource($department)
        ];
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentUpdateRequest $request, $id)
    {
        Department::whereId($id)->update($request->all());
        $department = Department::find($id);

        return [
            "message" => 'Department Updated ',
            'Department' => new CreateDepartmentResource($department)
        ];
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);
        if(!isset($department)){
            return[
                "message" => "Department not found ",
                "resposne" => response(404)
            ];
        }

        $department->delete();
        return [
            "message" => 'Department Deleted Succesfully ',
        ];
        //
    }
}
