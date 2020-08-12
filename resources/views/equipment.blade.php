@extends('layouts.app')
@section('content')
<style>
/* .card {
    width: 15rem;
} */
</style>
<div class="container">
    
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Danh sách thiết bị</h2>
        </div>
    </div>

    <div class="row">
        <select class="dropdown-primary mx-4">
            <option selected>Loại thiết bị</option>
            @foreach($categories as $category)
            <option>{{ $category->name }}</option>
            @endforeach
        </select>
    
        <a href="{{ route('equipment-template.create') }}" class="btn btn-success ml-auto">Thêm thiết bị</a>
    </div>
    
    <div class="row justify-content-center py-4">
        @foreach($equipmentTemplates as $template)
        <div class="col-md-3">
            <div class="card">
                <img src="{{ '/storage/img/'.$template->image }}" class="card-img-top" alt="{{ $template->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $template->name }}</h5>
                    <p class="card-text">Số lượng: {{ $template->equipments->count() }}</p>
                    <a href="#" class="btn btn-warning"><span class="fa fa-plus"></span> Thêm vào giỏ</a>
                    <a href="{{ route('equipment-template.show', $template) }}" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                    <button class="btn btn-danger" onclick="event.preventDefault();
                        if(confirm('Bạn có chắc chắn muốn xóa?')){
                            document.getElementById('form-delete-{{$template->id}}')
                            .submit()
                        }">
                        <span class="fa fa-trash"></span>
                    </button>
                    <form style="display:none" id="{{'form-delete-'.$template->id}}" method="post" action="{{route('equipment-template.destroy',$template)}}">
                        @csrf
                        @method('delete')
                    </form>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

@endsection