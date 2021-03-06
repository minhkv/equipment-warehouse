<!-- Add equipment -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEquipment">
    <span class="fa fa-plus"></span>
</button>

<!-- Modal -->
<div class="modal fade" id="addEquipment" tabindex="-1" role="dialog" aria-labelledby="addEquipmentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addEquipmentLabel">Thêm thiết bị</h5>
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
                        <th scope="col"></th>
                        <th scope="col">Tên thiết bị</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"><img src="/img/sony-ax700.webp" height=40 alt="sony-ax700"></th>
                        <td class="align-middle">Sony AX700</td>
                        <td class="align-middle">2</td>
                        <td class="align-middle">
                            <button type="button" disabled class="btn btn-success btn-sm"><span class="fa fa-plus" /></button>
                            <button type="button" class="btn btn-danger btn-sm"><span class="fa fa-minus" /></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><img src="/img/sony-ax700.webp" height=40 alt="sony-ax700"></th>
                        <td class="align-middle">Sony AX700</td>
                        <td class="align-middle">2</td>
                        <td class="align-middle">
                            <button type="button" class="btn btn-success btn-sm"><span class="fa fa-plus" /></button>
                            <button type="button" disabled class="btn btn-danger btn-sm"><span class="fa fa-minus" /></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><img src="/img/sony-ax700.webp" height=40 alt="sony-ax700"></th>
                        <td class="align-middle">Sony AX700</td>
                        <td class="align-middle">2</td>
                        <td class="align-middle">
                            <button type="button" class="btn btn-success btn-sm"><span class="fa fa-plus" /></button>
                            <button type="button" disabled class="btn btn-danger btn-sm"><span class="fa fa-minus" /></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><img src="/img/sony-ax700.webp" height=40 alt="sony-ax700"></th>
                        <td class="align-middle">Sony AX700</td>
                        <td class="align-middle">2</td>
                        <td class="align-middle">
                            <button type="button" class="btn btn-success btn-sm"><span class="fa fa-plus" /></button>
                            <button type="button" disabled class="btn btn-danger btn-sm"><span class="fa fa-minus" /></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><img src="/img/sony-ax700.webp" height=40 alt="sony-ax700"></th>
                        <td class="align-middle">Sony AX700</td>
                        <td class="align-middle">2</td>
                        <td class="align-middle">
                            <button type="button" class="btn btn-success btn-sm"><span class="fa fa-plus" /></button>
                            <button type="button" disabled class="btn btn-danger btn-sm"><span class="fa fa-minus" /></button>
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