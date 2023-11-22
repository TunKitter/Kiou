@extends('client.layouts.master')
@section('content')
<style>
    .tooltip-inner {
    background: #392c7d  !important
}
.tooltip-arrow::before {
    border-top-color: #392c7d !important
}

</style>
<div style="min-height: 70vh; display: flex;justify-content:center;align-items:center">
<button class="btn btn-primary" id="btn_start" onclick="this.style.display='none';$('.revision-wrapper').removeClass('d-none')">Click here to start to revise</button>
<div class="revision-wrapper align-self-start d-none">
    <div class="progress_current" style="background: gray">
        <div style="width: 0%;height: 2px;background: #fc7f50" id="progress"></div>
    </div>
    <br>
<div class="cards">
    <h4><i id="lesson">let in java </i> of <span class="text-primary" id="course">Python for beginner</span></h4>
<br>
    <textarea class="form-control" id="front_card"  style="resize: none" cols="100" rows="5"></textarea>
    <br>
<button class="btn btn-primary m-auto" id="show_card" style="display: block" onclick="this.style.display='none';$('#back_card').removeClass('d-none');$('.memory-type').removeClass('d-none')">Show</button>
<br>
    <textarea class="form-control d-none"  id="back_card" style="resize: none" cols="100" rows="5"></textarea>
</div>
<br>
<div class="memory-type d-flex justify-content-center gap-2 d-none">
    <button class="btn btn-primary" onclick="easy()" data-bs-toggle="tooltip" data-bs-placement="top" title="You can answer easily">Easy</button>
    <button class="btn btn-primary" onclick="normal()" data-bs-toggle="tooltip" data-bs-placement="top" title="You can answer correctly but take a little time">Normal</button>
    <button class="btn btn-primary" onclick="hard()" data-bs-toggle="tooltip" data-bs-placement="top" title="You need something to revise">Hard</button>
    <button class="btn btn-primary" onclick="forgot()" data-bs-toggle="tooltip" data-bs-placement="top" title="You're wrong or ensure the answer">Forgot</button>
</div>
<div class="finish d-none">
    <h1>Finish Your Revision</h1>
<p>Your are finished. Let's enjoy it</p>
<ul>
    <li>Total Revision: <span id="total_revise">12</span></li>
    <li>Remember: <span id="total_remember">6</span></li>
    <li>Need to relearn: <span id="total_need_relearn">8</span></li>
</ul>
<button class="btn btn-primary" onclick="saveData(this)">Go back</button>
</div>
</div>
</div>
<script>
const show_card = document.querySelector('#show_card');
    const data = [{!!$arr_cards!!}];
    if(data.length ==0 ) {
       document.querySelector('#btn_start').outerHTML = '<p class="d-flex flex-column gap-4">You are not have any card! That\'s good for you <button class="btn btn-primary" onclick=\'location.href ="{{route("revision-bookmark")}}"\'>Go back</button></p>';
    }
    const interval_time = [0,600000, 3600000, 18000000, 86400000, 604800000, 2505600000, 5011200000, 12528000000];
    const user_index = [{!!$arr_index!!}];
    const lesson = [{!!$lesson!!}];
    const course = [{!!$courses!!}];
    const bookmarks_id = [{!!$bookmarks_id!!}];
    console.log(bookmarks_id);
    var total_remember = 0;
    var total_need_relearn = 0;
    // $('#front_card').val(data[0][0]);
    // $('#back_card').val(data[0][1]);
    var index = 0
    const progress = document.querySelector('#progress');
            $('#front_card').val(data[0][0]);
            $('#back_card').val(data[0][1]); 
            $('#lesson').text(lesson[0]);
            $('#course').text(course[0]);
    function easy() {
        let temp_index = parseInt(user_index[index])+1
        total_remember++;
        if(temp_index < interval_time.length) {
        updateData(temp_index);
        }
        else {
            updateData()
        }
    }
    function normal() {
        total_need_relearn++;
        updateData();
    }
    function hard() {
        let temp_index = parseInt(user_index[index])-1
        total_need_relearn++;
        if(temp_index >= 0) {
        updateData(temp_index);
        }
        else {
        updateData();
        }
    }
    function forgot() {
        total_need_relearn++;
        updateData(parseInt(0));
    }
    function updateData(index_interval = -999) {
            if(index <  data.length) {
            progress.style.width = (index / (data.length-1)) * 100 + '%';
            if(index_interval != -999 || index == 0) {
            if(index == 0 && index_interval != -999) {
            user_index[0]= index_interval;
            }
            else if(index_interval != -999) {
              user_index[index]= index_interval;
            }
        }
            index++;
            if(index < data.length) {
            $('#front_card').val(data[index][0]);
            $('#back_card').val(data[index] [1]); 
            $('#lesson').text(lesson[index]);
            $('#course').text(course[index]);               
            }
            else {
            updateData();
            }
           
            show_card.style.display = 'block';
            $('#back_card').addClass('d-none');
            $('.memory-type').addClass('d-none')
         
            console.log(user_index,index);
        }
        else {
            $('#progress').addClass('d-none');
            $('.finish').removeClass('d-none');
            $('.cards').addClass('d-none');
            $('.memory-type').addClass('d-none');
            $('#total_revise').text(user_index.length);
            $('#total_remember').text(total_remember);
            $('#total_need_relearn').text(total_need_relearn);
            
        }
    }
    function saveData(obj) {
        obj.disabled = true;
        obj.innerText = 'Please wait...'
        let formData = new FormData();
        let aa = ''
        console.log(aa);
        var result_data = []
        user_index.map(e => {
            result_data.push(interval_time[e] + Date.now());
        })
        console.log(result_data);
        formData.append('data', JSON.stringify(result_data));
        formData.append('ids_change', JSON.stringify(user_index));
        formData.append('ids', JSON.stringify(bookmarks_id));
        fetch('{{route("revision-bookmark-revise")}}/update', {
            method: 'POST',
            body: formData
        }).then(res => res.json()).then(data => {
           location.href = '{{route("revision-bookmark")}}';
        })
    }
</script>
@endsection