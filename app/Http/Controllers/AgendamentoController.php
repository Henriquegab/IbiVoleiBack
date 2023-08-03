<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Http\Requests\StoreAgendamentoRequest;
use App\Http\Requests\UpdateAgendamentoRequest;
use Carbon\Carbon;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carbon = new Carbon();
        $hoje = $carbon->today()->copy();
        $ultimo = $carbon->addDays(6)->endOfDay()->copy();
        // dd($carbon->format('d'));
        $agendamentos = Agendamento::whereBetween('data',[$hoje, $ultimo])->get();

        $dias = [];

        for($i=0;$i<7;$i++){
            for($k=0;$k<24;$k++){
                $dias[$i][$k.'h'] = null;
            }
        }

        // dd($agendamentos);

        foreach($agendamentos as $agendamento){
            $hora = new Carbon($agendamento->data);
            $diferenca = $hora->diffInDays($hoje);
            $diferencaHoras = $hora->diffInHours($agendamento->fim);
            for($a=0;$a<$diferencaHoras;$a++){
                $intDia = intval($hora->format('H'));
                if($intDia+$a >= 24){
                    $intDia = $intDia-24;
                    $dias[$diferenca+1][$intDia+$a.'h'] = $agendamento;
                }
                else{
                    $dias[$diferenca][$intDia+$a.'h'] = $agendamento;
                }

            }


        }

        // dd(1);
        // $dia1[0] = ['01:00' => 'akira'];
        // $dia1[1] = ['02:00' => 'udd'];

        // dd($dia1);

        return response()->json([
            'success' => true,
            'message'=>'Agendamentos retornados com sucesso!',
            'data' => $dias
        ],201);
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
    public function store(StoreAgendamentoRequest $request)
    {
        $data = $request->all();
            foreach ($data as $key => $value) {
                if ($value === null) {
                    unset($data[$key]);
                }
            }

        $agendamento = Agendamento::create($data);

        return response()->json([
            'success' => true,
            'data' => $agendamento
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Agendamento $agendamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agendamento $agendamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgendamentoRequest $request, Agendamento $agendamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agendamento $agendamento)
    {
        //
    }
}
