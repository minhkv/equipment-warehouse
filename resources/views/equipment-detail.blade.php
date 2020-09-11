@extends('layouts.app')
@section('content')
<equipment-detail
    :equipment-template-index-url="{{ json_encode(route('equipment-template.index')) }}"
    :equipment-template-update-url="{{ json_encode(route('equipment-template.update', $equipmentTemplate)) }}"
    :equipment-index-url="{{ json_encode(route('equipment.index')) }}"
    :equipment-create-url="{{ json_encode(route('equipment.store')) }}"
    :equipment-template="{{ json_encode($equipmentTemplate) }}"
    :suppliers="{{ json_encode($suppliers) }}"
    ></equipment-detail>
@endsection
