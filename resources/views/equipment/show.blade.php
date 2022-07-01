@extends('layouts.app')

@section('content')

    <div class="card staff-card m-auto">
        <div class="card-body">
            <h5 class="card-title">Код типа оборудования: <b>{{$equipment->code_of_type_equipment}}</b></h5>
            <p class="card-text mb-1">Серийный номер: <b>{{$equipment->serial_number}}</b></p>
            <p class="card-text mb-0">Примечание: <b>{{$equipment->note}}</b></p>
        </div>
    </div>

@endsection
