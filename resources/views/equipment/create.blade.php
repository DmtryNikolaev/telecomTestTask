@extends('layouts.app')

@section('content')

    {{ Form::model($equipment, ['route' => 'equipment.store', 'class' => 'd-flex justify-content-between flex-column gap-10 mt-4 w-25 m-auto', 'enctype' => 'multipart/form-data']) }}
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
    {{ Form::submit('Добавить', ['class' => 'form-control mt-2 btn btn-primary']) }}
    {{ Form::close() }}

@endsection

