@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Atendimentos</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Prioridade</th>
                                <th>Espera</th>
                                <th>Atender</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($atendimentos as $atendimento)
                            <tr>
                                <td>{{$atendimento['paciente']}}</td>
                                <td>{{$atendimento['prioridade']}}</td>
                                <td>{{$atendimento->created_at->diffForHumans()}}</td>
                                <td>
                                    
                                    {!! Form::open(['url'=>"attendance/$atendimento->id",'method'=>'PUT']) !!}
                                        <button type="submit" class='form-control btn-sm'>Atender</button>
                                    {!! Form::close() !!}
                                    
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
