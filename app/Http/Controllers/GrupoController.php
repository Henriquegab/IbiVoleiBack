<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Http\Requests\StoreGrupoRequest;
use App\Http\Requests\UpdateGrupoRequest;
use App\Models\GrupoUser;
use App\Models\User;
use Exception;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grupos = Grupo::all();

        return response()->json([
            'success' => true,
            'message' => 'Grupos recuperados',
            'data' => $grupos
        ],200);
    }

    public function usuario_grupos($id)
    {
        try{
            $grupos = User::find($id);



            if(is_null($grupos->grupo->first())){
                return response()->json([
                    'success' => false,
                    'message' => 'Nenhum grupo encontrado!',

                ],400);
            }

            return response()->json([
                'success' => true,
                'message' => 'Grupos do usuário recuperados!',
                'data' => $grupos->grupo
            ],200);
        }
        catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Grupos não recuperados!',

            ],500);
        }


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGrupoRequest $request)
    {
        $grupo = Grupo::create($request->all());
        $grupoUser = GrupoUser::create([
            'user_id' => 1,
            'grupo_id' => $grupo->id,
            'admin' => 1,
            'status' => 1
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Grupo cadastrado!',
            'data' => $grupo
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Grupo $grupo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grupo $grupo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGrupoRequest $request, Grupo $grupo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grupo $grupo)
    {
        //
    }
}
