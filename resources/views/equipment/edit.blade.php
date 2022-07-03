@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{ Form::model($equipment, ['route' => ['equipment.update', $equipment], 'method' => 'PATCH',  'class' => 'd-flex justify-content-between flex-column gap-10 mt-4 w-25 m-auto', 'enctype' => 'multipart/form-data']) }}
    <input type="hidden" name="api_token" value="{{config('apitokens')[0]}}">
    <div class="mb-1">
        <label for="staticEmail" class="col-form-label">Тип оборудования</label>
        <div class="input-form">
            {{ Form::select('code_of_type_equipment', ['1' => 'TP-Link TL-WR74', '2' => 'D-Link DIR-300', '3' => 'D-Link DIR-300 S'], null, ['class' => 'form-select'])}}
        </div>
    </div>

    <div class="mb-1">
        <label for="staticEmail" class="col-form-label">Серийные номера</label>
        <div class="input-form">
            {{ Form::textarea('serial_number', null, ['class' => 'form-control']) }}
        </div>
    </div>

    <div class="mb-1">
        <label for="staticEmail" class="col-form-label">Примечание</label>
        <div class="input-form">
            {{ Form::textarea('note', null, ['class' => 'form-control']) }}
        </div>
    </div>

    {{ Form::submit('Изменить', ['class' => 'form-control mb-4 btn btn-primary']) }}
    {{ Form::close() }}

@endsection
