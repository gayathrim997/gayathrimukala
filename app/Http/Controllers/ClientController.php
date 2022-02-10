<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Models\Client as ModelsClient;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Models\Client;

class ClientController extends Controller
{
    //
    //@param \Illuminate\Http\Request
     //@return \Illuminate\Http\Response


public function index()
{
    $clients = ModelsClient::all();
    return[
       "Clients"=> ClientResource::collection($clients)
    ];
}

//@return\Illuminate\Http\Response
public function show($id)
{
$clients = ModelsClient::whereid($id)->first();
    return[
        'message'=>"the required client for this{$id}",
        'client'=>new ClientResource($clients)
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
$clients = ModelsClient::create([
    // 'client_id'=>$request->id,
            'name'=>$request->name,
            'description'=>$request->description,
            'department_id'=>$request->department_id,
            'added_by'=>$request->added_by,
            'status'=>$request->status,
        ]);
  return new ClientResource($clients);
}

 //
    //@param \Illuminate\Http\Request
     //@return \Illuminate\Http\Response
public function update(Request $request,$id)
{
$clients=ModelsClient::whereId($id)->update($request->all());
return[
    "message"=>'client Updated',
    'client'=>ClientResource::collection(ModelsClient::all())
];
}
public function destroy($id)
{
    $crud=ModelsClient::find($id);  
    if($crud)
    {
        $crud->delete(); 
        return $crud; 
    }else{
        // abort(400, "Client not found");
        return response("Client not found", 400);
    }

}
}