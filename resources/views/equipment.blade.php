@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/card.css">
<equipment-templates 
    :eqs="{{json_encode($equipmentTemplates)}}"
    :equipment-templates="{{json_encode($equipmentTemplates)}}"
    :categories="{{json_encode($categories)}}"
    :equipment-template-index-url="{{json_encode(route('equipment-template.index'))}}"
    :equipment-template-create-url="{{json_encode(route('equipment-template.create'))}}"></equipment-templates>
@endsection