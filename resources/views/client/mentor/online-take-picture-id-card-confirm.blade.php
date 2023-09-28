@extends('client.layouts.mentor_auth')
@section('content')
<style>
    .cccd_img {
        filter: blur(2px);
    }
.cccd_img_parent {
    position: relative;
}
#loader {
    position: absolute;
    top: 10px;
    left: 10px;
}
</style>
<div class="login-wrapper">
    <div class="loginbox">
    <div class="w-100">
    <div class="img-logo">
    <img src="{{asset('assets/img/logo.svg')}}" class="img-fluid" alt="Logo">
    
    </div>
    <h1>Take your identify card online</h1>
    <form action="{{route('mentor-register')}}" method="POST">
        @csrf
    <div class="form-group">
    <label class="form-control-label">Front ID CARD</label>
<div class="d-flex justify-content-center">

    <div id="my_camera" style="width:320px; height:240px;"></div>
</div>
<br>
    <div class="profile-share d-flex align-items-center justify-content-center">
    <label href="javascript:;" class="btn btn-primary text-white" id="btn_front_id" onclick="take_snapshot('my_camera')">Take Snapshot</label>
    <input type="file" style="display: none" id="front_id" onchange="uploadImage(this,'front_id')">
    </div>
    </div>
<div class="form-group">
    <label class="form-control-label">Back ID CARD</label>
<div class="d-flex justify-content-center">

    <div id="my_camera2" style="width:320px; height:240px;"></div>
</div>
<br>
    <div class="profile-share d-flex align-items-center justify-content-center">
    <label href="javascript:;" class="btn btn-primary text-white" onclick="take_snapshot('my_camera2')" id="btn_back_id">Take Snapshot</label>
    <input type="file" style="display: none" id="front_id" onchange="uploadImage(this,'front_id')">
    </div>
    </div>
    </form> 
<div class="id-infor" style="display: none">
            <div
                class="card relative h-[260px] w-[400px] flex flex-col justify-end px-6 py-10 text-white rounded-3xl gap-8 bg-gradient-to-r from-orange-300 to-orange-400">
                <p class="text-md font-small" id="id_card_address">5430 4900 3232 9755</p>
                <p class="text-2xl font-medium" id="id_card_infor">5430 4900 3232 9755</p>
                <div class="flex justify-between gap-10">
                    <p class="text-lg font-medium" id="name_card_infor">Elon Musk</p>
                    <div class="flex-1 flex flex-col justify-end">
                        <p class="self-end">Date of Birth</p>
                        <p class="self-end" id="valid_date_card_infor">2/14/2024</p>
                    </div>
                    <div class="self-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 58 36" height="36" width="58">
                            <circle fill-opacity="0.62" fill="#F9CCD1" r="18" cy="18" cx="18"></circle>
                            <circle fill="#424242" r="18" cy="18" cx="40" opacity="0.36"></circle>
                        </svg>
                    </div>
                </div>
            </div>
            <p id="where_card_infor" style="display: none;margin-top: -1em; margin-bottom: 1.4em" class="text-success">
                Được cấp bởi: </p>

            </div>
            <div class="d-grid">
                <button class="btn btn-primary btn-start" type="submit" disabled>Đăng ký mentor</button>
                <br>
                <a class="link-secondary" href="{{route('mentor-upload-id-card')}}">Hoặc upload ảnh tại đây</a>
            </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js" integrity="sha512-dQIiHSl2hr3NWKKLycPndtpbh5iaHLo6MwrXm7F0FM5e+kL2U16oE9uIwPHUl6fQBeCthiEuV/rzP3MiAB8Vfw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
const btn_front_id = document.querySelector('#btn_front_id');
const btn_back_id = document.querySelector('#btn_back_id');
const id_infor = document.querySelector('.id-infor');
Webcam.attach( '#my_camera' );
Webcam.attach( '#my_camera2' );
		function take_snapshot(camera_id) {
let formData = new FormData();
			Webcam.snap( function(data_uri) {
                var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
                urltoFile(data_uri, 'name.jpg','text/plain')
.then(function(file)
{ 
    formData.append('image',file)
    loading_cccd(camera_id,data_uri)
    fetch('https://api.fpt.ai/vision/idr/vnm',{
            method: 'POST',
            headers: {
                'api_key': 'dGDWECzEw8eeN5BGCj7jTJimuJMiMvlS'
            },
            body: formData
        }).then(res => res.json())
        .then(data => {
            console.log(data);
            if(data['errorCode'] == 0) {
            if(data['data'][0]['type'] == 'chip_back' && camera_id == 'my_camera2'){ 
                document.querySelector('#where_card_infor').style.display = 'block'
                document.querySelector('#where_card_infor').innerHTML += '<b>' + data['data'][0]['issue_loc'] + '</b>'
                success_cccd(camera_id,'.loader_'+camera_id,camera_id == 'my_camera2' ? btn_back_id : btn_front_id);
            }
            else if(data['data'][0]['type'] == 'chip_front' && camera_id == 'my_camera'){

                let result_id = data['data'][0]
                success_cccd(camera_id,'.loader_'+camera_id,camera_id == 'my_camera2' ? btn_back_id : btn_front_id);
                document.querySelector('#id_card_infor').innerHTML = result_id['id']
                document.querySelector('#name_card_infor').innerHTML = result_id['name']
                document.querySelector('#valid_date_card_infor').innerHTML = result_id['dob']
                document.querySelector('#id_card_address').innerHTML = result_id['address']
                id_infor.style.display = 'block'
            }
            else {
                fail_cccd(camera_id,'.loader_'+camera_id,camera_id == 'my_camera2' ? btn_back_id : btn_front_id);
            }
            }
            else{
    fail_cccd(camera_id,'.loader_'+camera_id,camera_id == 'my_camera2' ? btn_back_id : btn_front_id);
            }
            

        });
});
			} );
		}
       
        function urltoFile(url, filename, mimeType){
    if (url.startsWith('data:')) {
        var arr = url.split(','),
            mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[arr.length - 1]), 
            n = bstr.length, 
            u8arr = new Uint8Array(n);
        while(n--){
            u8arr[n] = bstr.charCodeAt(n);
        }
        var file = new File([u8arr], filename, {type:mime || mimeType});
        return Promise.resolve(file);
    }
    return fetch(url)
        .then(res => res.arrayBuffer())
        .then(buf => new File([buf], filename,{type:mimeType}));
}

function loading_cccd(camera_id,data_uri) {
    document.getElementById(camera_id).innerHTML = '<div class="cccd_img_parent"><img src="'+data_uri+'" class="cccd_img '+ camera_id+'" /><div class="spinner-border mb-2 loader_'+camera_id+'" id="loader" style="color: #f66962;" role="status"><span class="visually-hidden">Loading...</span></div> </div>';
// setTimeout(() => {
//     fail_cccd(camera_id,'.loader_'+camera_id,camera_id == 'my_camera2' ? btn_back_id : btn_front_id);
// }, 2000);

}
function success_cccd(camera_id,loader_id,btn_id) {
    document.querySelector('.cccd_img.'+camera_id).style.border = '5px solid #00e676';
        document.querySelector(loader_id).style.display = 'none';
        btn_id.style.background = '#00e676';
        const successStyle = {
            background: '#159f46',
            color: 'white',
            border: 'none',
                            }
        Object.assign(btn_id.style, successStyle)
        btn_id.innerHTML = 'Success';
            btn_id.onclick = () => {
                location.reload()
            }
}
function fail_cccd(camera_id,loader_id,btn_id) {
    document.querySelector('.cccd_img.'+camera_id).style.border = '5px solid #f66962';
        document.querySelector(loader_id).style.display = 'none';
        btn_id.style.background = '#f66962';
        const failStyle = {
            background: '#f66962',
            color: 'white',
            border: 'none',
                            }
        Object.assign(btn_id.style, failStyle)
        btn_id.innerHTML = 'Failed';
        setTimeout(() => {
            document.querySelector('#'+camera_id).innerHTML = ' <div id="my_camera" style="width:320px; height:240px;"></div>'
            Webcam.attach('#'+camera_id);
        }, 1000);
                
}
 </script>
<script src="https://cdn.tailwindcss.com"></script>
@endsection