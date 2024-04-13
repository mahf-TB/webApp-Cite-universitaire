<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{ 
    public function indexResto()
    {

        $Mainte = Service::with('user')->orderBy('created_at', 'desc')->get();

        $dataRes =  $Mainte->map(function ($items) {
            return [
                "id" => $items->id,
                "nom_service" => $items->nom_service,
                "description" => $items->description,
                "tarifs" => $items->tarifs,
                "dispo" => $items->disponible,
                "image" => $items->image != null ? $items->imageUrl() :'',
                "user" => $items->user->username,
                "date" => $items->created_at,
            ];
        })->values();
      
        return  $dataRes;
    }


    public function ajouterService(ServiceRequest $request)
    {
        $data = $request->validated();
        $image = $request->file('image');

        if ($request->hasFile('image')) {
            $data['image'] = $image->store('/ServiceImage', 'public');
        }
        $main = Service::create($data);
        if ($main) {
            return response()->json([
                'message' => 'Enregistrer bien effectuer',
                'status' =>  true
            ]);
        } else {
            return response()->json([
                'message' => 'Failed..! Enregistrer echec',
                'status' =>  false
            ]);
        }
    }
}