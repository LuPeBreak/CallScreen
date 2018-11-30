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
                                <th>Medico</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($atendimentos as $atendimento)
                            <tr>
                                <td>{{$atendimento['paciente']}}</td>
                                <td>{{$atendimento['prioridade']}}</td>
                                <td>{{$atendimento->created_at->diffForHumans()}}</td>
                                <td>{{$atendimento->user['name']}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">

                {!! Form::open(['url'=>'attendance']) !!}
                <br>
                <div class="form-group row">
                    <label for="paciente" class="col-md-4 col-form-label text-md-right">Paciente</label>

                    <div class="col-md-6">
                        {!! Form::text('paciente',null,['class'=>'form-control']) !!}
                        

                        @if ($errors->has('paciente'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('paciente') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="medico" class="col-md-4 col-form-label text-md-right">Medico</label>

                    <div class="col-md-6">

                        <select class="form-control" name="medico">
                            @foreach ($medicos as $medico)
                            <option value="{{$medico['id']}}">{{$medico['name']}}</option>
                            @endforeach
                        </select>



                        @if ($errors->has('medico'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('medico') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="prioridade" class="col-md-4 col-form-label text-md-right">Prioridade</label>

                    <div class="col-md-6">

                        {!! Form::select('prioridade', [
                        'alta'=>'alta',
                        'media'=>'media',
                        'baixa'=>'baixa'
                        ], null , ['class'=>'form-control']) !!}


                        @if ($errors->has('prioridade'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('prioridade') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                {!! Form::submit('Criar', ['class'=>'form-control']) !!}

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection
