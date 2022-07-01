@extends('layouts.app')

@section('content')
    <h3 class="mb-3">Тип оборудования</h3>
    <div class="equipments">
        @foreach ($equipmentType as $elem)
            <div class="border border-secondary p-2 rounded-3 staff__item">
                <div class="d-flex">
                    Наименование типа: <b>{{$elem->type_name}}</b>
                </div>
                <div class="d-flex">
                    Маска серийного номера: <b>{{$elem->serial_number_mask}}</b>
                </div>
                {{ Form::close() }}
            </div>
        @endforeach
    </div>
@endsection
