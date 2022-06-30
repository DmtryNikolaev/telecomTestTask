@extends('layouts.app')

@section('content')
<h3 class="mb-3">Список оборудования</h3>
<div class="equipments">
    @foreach ($equipment as $elem)
    <div class="border border-secondary p-2 rounded-3 staff__item">
        <div class="d-flex">
            Код типа оборудования: <b>{{$elem->code_of_type_equipment}}</b>
        </div>
        <div class="d-flex">
            Серийный номер: <b>{{$elem->serial_number}}</b>
        </div>
        <div class="d-flex">
            Примечание: <b>{{$elem->note}}</b>
        </div>

{{--        {{ Form::open(['route' => ['staff.destroy', $employee], 'method' => 'delete', 'class' => 'd-inline-block w-100 mt-2']) }}--}}
{{--        <div class="d-flex justify-content-between">--}}
{{--            <button type="submit" class="btn btn-primary" data-confirm="Вы уверены?" data-method="delete"--}}
{{--                rel="nofollow">Удалить</button>--}}
{{--            <a href="{{ route('staff.edit', $employee) }}" class="btn btn-primary">Редактировать</a>--}}
{{--            <a href="{{ route('staff.show', $employee) }}" class="btn btn-primary">Посмотреть</a>--}}
{{--        </div>--}}
        {{ Form::close() }}
    </div>
    @endforeach
</div>
@endsection
