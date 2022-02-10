<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProjectResource;
use App\Models\Project as ModelsProject;
use Illuminate\Database\Eloquent\Models\Project;


class ProjectController extends Controller
{
    //

//
    //@param \Illuminate\Http\Request
     //@return \Illuminate\Http\Response


     public function index()
     {
         $projects = ModelsProject::all();
         return[
            "projects"=> ProjectResource::collection($projects)
         ];
     }
     
     //@return\Illuminate\Http\Response
     public function show($id)
     {
     $projects = ModelsProject::whereid($id)->first();
         return[
             'message'=>"the required project for this{$id}",
             'project'=>new ProjectResource($projects)
             ];
     
     }
     
     public function edit($id)
     {
     //
     }
     
      //
         //@param \Illuminate\Http\Request
          //@return \Illuminate\Http\Response
     
     
     public function create(Request $request)
     {
     $projects = ModelsProject::create([
         // 'project_id'=>$request->id,
                 'name'=>$request->name,
                 'description'=>$request->description,
                 'client_id'=>$request->client_id,
                 'added_by'=>$request->added_by,
                 'status'=>$request->status,
             ]);
       return new ProjectResource($projects);
     }
     
      //
         //@param \Illuminate\Http\Request
          //@return \Illuminate\Http\Response
     public function update(Request $request,$id)
     {
     $projects=ModelsProject::whereId($id)->update($request->all());
     return[
         "message"=>'project Updated',
         'project'=>ProjectResource::collection(ModelsProject::all())
     ];
     }
     public function destroy($id)
     {
         $crud=ModelsProject::find($id);  
         if($crud)
         {
             $crud->delete(); 
             return $crud; 
         }else{
             // abort(400, "Client not found");
             return response("Project not found", 400);
         }
     
     }
     }
