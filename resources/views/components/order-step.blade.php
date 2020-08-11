<div class="track">
    <div class="step {{$current >=0 ? 'active' : ''}}"> 
        <span class="icon"> <i class="fa fa-file"></i> </span> 
        <span class="text">Tạo đơn hàng</span> 
        <span class="text-muted">20/07/2020 5:00:00</span> 
    </div>
    <div class="step {{$current >=1 ? 'active' : ''}}"> 
        <span class="icon"> <i class="fa fa-check"></i> </span> 
        <span class="text">Chấp nhận</span> 
        <span class="text-muted">20/07/2020 5:10:00</span>
    </div>
    <div class="step {{$current >=2 ? 'active' : ''}}"> 
        <span class="icon"> <i class="fa fa-user"></i> </span> 
        <span class="text"> Xuất đồ</span> 
        <span class="text-muted">20/07/2020 6:00:00</span>
    </div>
    <div class="step {{$current >=3 ? 'active' : ''}}"> 
        <span class="icon"> <i class="fa fa-truck"></i> </span> 
        <span class="text"> Trả đồ </span> 
    </div>
    <div class="step {{$current >=4 ? 'active' : ''}}"> 
        <span class="icon"> <i class="fa fa-box"></i> </span> 
        <span class="text">Hoàn tất</span> 
    </div>
</div> 
<hr>
<div class="row justify-content-center">
    <h3>
        @switch($current)
            @case(0)
                Duyệt đơn
                @break
            @case(1)
                Chọn đồ
                @break
            @case(2)
                Kiểm đồ
                @break
            @case(3)
                Hoàn tất
                @break
        @endswitch
    </h3>
</div>
<ul class="row justify-content-center">
    <li class="col-md-4">
        <figure class="itemside mb-3">
            <div class="aside"><img src="/img/tripod.jpg" class="img-sm border"></div>
            <figcaption class="info align-self-center">
                <p class="title">Tripod</p> <span class="text-muted">Số lượng: 2 </span>
                @if($current == 1)
                <x-equipment-amount eId="SN002" name="Sony PJ440" amount="2" />
                @elseif($current == 2)
                <x-equipment-amount eId="SN002" name="Sony PJ440" amount="2" />
                @endif
            </figcaption>
        </figure>
    </li>
</ul>
<hr>
<div class="row justify-content-center">
    @switch($current)
        @case(0)
            <button class="btn btn-primary mx-2" data-abc="true">Chấp nhận</button>
            <button class="btn btn-danger" data-abc="true">Từ chối</button>
            @break
        @case(1)
            <button class="btn btn-primary" data-abc="true">Xuất đồ</button>
            @break
        @case(2)
            <button class="btn btn-primary" data-abc="true">Trả đồ</button>
            @break
        @case(3)
            <button class="btn btn-primary" data-abc="true">Hoàn tất</button>
            @break
        @case(4)
            <button class="btn btn-primary" data-abc="true">Quay lại</button>
            @break
    @endswitch
</div>