<div id="{{ $id }}">
    <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
        <input type="radio" id="star5-{{$id}}" name="{{$name}}" value="5" {{ $value == 5 ? 'checked':'' }} /><label for="star5-{{$id}}" onmouseout="normalText('scoreDescription-{{$id}}')" onmouseover="changeText('scoreDescription-{{$id}}', 'Hoàn hảo')" title="5 star">5</label>
        <input type="radio" id="star4-{{$id}}" name="{{$name}}" value="4" {{ $value == 4 ? 'checked':'' }} /><label for="star4-{{$id}}" onmouseout="normalText('scoreDescription-{{$id}}')" onmouseover="changeText('scoreDescription-{{$id}}', 'Tốt')" title="4 star">4</label>
        <input type="radio" id="star3-{{$id}}" name="{{$name}}" value="3" {{ $value == 3 ? 'checked':'' }} /><label for="star3-{{$id}}" onmouseout="normalText('scoreDescription-{{$id}}')" onmouseover="changeText('scoreDescription-{{$id}}', 'Bình thường')" title="3 star">3</label>
        <input type="radio" id="star2-{{$id}}" name="{{$name}}" value="2" {{ $value == 2 ? 'checked':'' }} /><label for="star2-{{$id}}" onmouseout="normalText('scoreDescription-{{$id}}')" onmouseover="changeText('scoreDescription-{{$id}}', 'Không tốt')" title="2 star">2</label>
        <input type="radio" id="star1-{{$id}}" name="{{$name}}" value="1" {{ $value == 1 ? 'checked':'' }} /><label for="star1-{{$id}}" onmouseout="normalText('scoreDescription-{{$id}}')" onmouseover="changeText('scoreDescription-{{$id}}', 'Kém')" title="1 star">1</label>
    </div>
    <div class="d-flex justify-content-center">
        <p id="scoreDescription-{{$id}}">Đánh giá</p>
    </div>
</div>
<style>
    .checked {
    color: orange;
    }
    .starrating > input {display: none;}  /* Remove radio buttons */

    .starrating > label:before { 
    content: "\f005"; /* Star */
    margin: 2px;
    font-size: 2em;
    font-family: FontAwesome;
    display: inline-block; 
    }

    .starrating > label
    {
    color: #222222; /* Start color when not clicked */
    }

    .starrating > input:checked ~ label
    { color: #ffca08 ; } /* Set yellow color when star checked */

    .starrating > input:hover ~ label
    { color: #ffca08 ;  } /* Set yellow color when star hover */


</style>
<script>
    function normalText(id, selected) {
        document.getElementById(id).innerHTML = "Đánh giá";
    }
    function changeText(id, text) {
        document.getElementById(id).innerHTML = text;
    }
</script>
