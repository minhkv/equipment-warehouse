@extends('layouts.app')
@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Combo thiết bị</h2>
        </div>
    </div>

    <div class="row">
        <a href="{{ route('combo.create') }}" class="btn btn-success ml-auto">Tạo combo</a>
    </div>
    
    <div class="row justify-content-center py-4">
        @foreach($combos as $combo)
        <div class="col-md-3">
            <div class="card">
                @if($combo->comboInfos->count() > 0)
                <img src="{{ $combo->comboInfos[0]->template->image }}" class="card-img-top" alt="{{$combo->name}}">
                @else
                <img src="/storage/img/empty.jpg" class="card-img-top" alt="{{$combo->name}}">
                @endif
                <div class="card-body">
                    <h2 class="card-title">{{ $combo->name }}</h2>
                    <p class="card-text">Số lượng: {{ $combo->comboInfos->count() }}</p>
                    <a href="#" class="btn btn-warning"><span class="fa fa-plus"></span> Thêm vào giỏ</a>
                    <a href="{{ route('combo.show', $combo) }}" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                    <x-delete-button route-name="combo.destroy" id="{{$combo->id}}" />
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection