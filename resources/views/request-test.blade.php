<form id="request-test" action="{{ route('equipment-template.destroy', $equipmentTemplate) }}" method="POST">
    @method('DELETE')
    @csrf
    <input type="text" name="name" placeholder="name" />
    <input type="text" name="image" placeholder="image" />
    <button type="submit">Submit</button>
</form>