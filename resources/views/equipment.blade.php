@extends('layouts.app')
@section('content')
<style>
    .card {
        min-height: 400px;
    }
</style>
<link rel="stylesheet" href="/css/card.css">
<div class="container">

    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Danh sách thiết bị</h2>
        </div>
    </div>

    <div class="row">
        <select class="dropdown-primary mx-4 shadow">
            <option selected>Loại thiết bị</option>
            @foreach($categories as $category)
            <option>{{ $category->name }}</option>
            @endforeach
        </select>

        <a href="{{ route('equipment-template.create') }}" class="btn btn-success ml-auto shadow">Thêm thiết bị</a>
    </div>

    <div class="row justify-content-center py-4">
        @if($equipmentTemplates->count() > 0)
        @foreach($equipmentTemplates as $template)
        <div class="col-md-3 my-2">
            <div class="card fast-transition">
                <a href="{{ route('equipment-template.show', $template) }}">
                    <img src="{{ $template->image }}" class="card-img-top" alt="{{ $template->name }}">
                </a>
                <div class="card-body d-flex flex-column">
                    <div class="card-block mt-auto my-1">
                        <h5 class="card-title">{{ $template->name }}</h5>
                        <p class="card-text">Số lượng: {{ $template->equipments->count() }}</p>
                    </div>
                    <div>
                        <a href="#" class="btn btn-warning"><span class="fa fa-plus"></span> Thêm vào giỏ</a>
                        <a href="{{ route('equipment-template.show', $template) }}" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                        <x-delete-button id="{{ $template->id }}" route-name="equipment-template.destroy" />
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <h5>Chưa có thiết bị nào.</h5>
        @endif
    </div>
</div>


@endsection