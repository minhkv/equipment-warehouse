<button class="btn btn-danger" onclick="event.preventDefault();
    if(confirm('Bạn có chắc chắn muốn xóa?')){
        document.getElementById('form-delete-{{$id}}')
        .submit()
    }">
    <span class="fa fa-trash"></span>
</button>
<form style="display:none" id="{{'form-delete-'.$id}}" method="post" action="{{route($routeName,$id)}}">
    @csrf
    @method('delete')
</form>