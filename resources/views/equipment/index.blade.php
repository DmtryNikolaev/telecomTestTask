@extends('layouts.app')

@section('content')
<h3 class="mb-3">Список оборудования</h3>
<div class="equipments">
    @foreach ($equipment as $elem)
    <div class="border border-secondary p-2 rounded-3 staff__item">
        <input type="hidden" name="api_token" value="{{config('apitokens')[0]}}">
        <div class="d-flex">
            Код типа оборудования: <b>{{$elem->code_of_type_equipment}}</b>
        </div>
        <div class="d-flex">
            Серийный номер: <b>{{$elem->serial_number}}</b>
        </div>
        <div class="d-flex">
            Примечание: <b>{{$elem->note}}</b>
        </div>

        {{ Form::open(['route' => ['equipment.destroy', $elem], 'method' => 'delete', 'class' => 'd-inline-block w-100 mt-2']) }}
        <input type="hidden" name="api_token" value="{{config('apitokens')[0]}}">
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</button>
            <a href="{{ route('equipment.edit', $elem) }}?api_token={{config('apitokens')[0]}}" class="btn btn-primary">Редактировать</a>
            <a href="{{ route('equipment.show', $elem) }}?api_token={{config('apitokens')[0]}}" class="btn btn-primary">Посмотреть</a>
        </div>
        {{ Form::close() }}
    </div>
    @endforeach
</div>
@endsection
