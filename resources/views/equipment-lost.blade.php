@extends('layouts.app')
@section('content')
<equipment-lost
    :lost-equipments="{{ json_encode($lostEquipments) }}"
    :recent-order-infos="{{ json_encode($recentOrderInfos) }}"
    :equipment-index-url="{{ json_encode(route('equipment.index')) }}"
    ></equipment-lost>
@endsection