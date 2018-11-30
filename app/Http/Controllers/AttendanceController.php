<?php

namespace App\Http\Controllers;

use App\attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AttendanceController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(Auth::user()['type']==="medico"){
            $atendimentos = attendance::select()->where(['user_id'=>Auth::user()['id'] , 'chamado'=>false])->orderby('created_at','asc')->get();
            return view('medico.home',compact('atendimentos'));

        }elseif(Auth::user()['type']==="atendente"){
            $medicos = User::all()->where('type','medico');
            $atendimentos = attendance::select()->orderby('created_at','asc')->get();

            return view('atendente.home',compact('atendimentos','medicos'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $criado = User::findOrFail($request['medico'])->attandances()->create([
            "paciente"=>$request['paciente'],
            "prioridade"=>$request['prioridade'],
            "chamado"=>false,
        ]);
        return back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, attendance $attendance)
    {
        $attendance->update([
            "chamado"=>true,
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(attendance $attendance)
    {
        //
    }
}
