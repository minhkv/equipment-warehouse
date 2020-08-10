<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#{{'editCard'.$eId}}">
    <span class="fa fa-pencil" />
</button>

<!-- Modal -->
<div class="modal fade" id="{{'editCard'.$eId}}" tabindex="-1" role="dialog" aria-labelledby="EditTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditTitle">{{ $name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="my-2 my-lg-0 px-2">
                    <div class="input-group">
                        <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm" aria-label="search" aria-describedby="basic-addon2">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><span class="fa fa-search"></span></button>
                    </div>
                </form>
                <table class="table mt-2">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Mã thiết bị</th>
                            <th scope="col">Tình trạng</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle">SN0001</td>
                            <td class="align-middle"><span class="badge badge-success">Tốt</span></td>
                            <td class="align-middle">
                                <input type="checkbox" checked="true" aria-label="Checkbox for following text input">
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">SN0001</td>
                            <td class="align-middle"><span class="badge badge-success">Tốt</span></td>
                            <td class="align-middle">
                                <input type="checkbox" aria-label="Checkbox for following text input">
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">SN0001</td>
                            <td class="align-middle"><span class="badge badge-success">Tốt</span></td>
                            <td class="align-middle">
                                <input type="checkbox" aria-label="Checkbox for following text input">
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">SN0001</td>
                            <td class="align-middle"><span class="badge badge-success">Tốt</span></td>
                            <td class="align-middle">
                                <input type="checkbox" aria-label="Checkbox for following text input">
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">SN0001</td>
                            <td class="align-middle"><span class="badge badge-success">Tốt</span></td>
                            <td class="align-middle">
                                <input type="checkbox" aria-label="Checkbox for following text input">
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                <div class="row justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link active" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>