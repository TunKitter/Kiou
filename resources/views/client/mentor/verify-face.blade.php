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
    <h1>Take your face</h1>
    <form action="{{route('mentor-face-verify')}}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="form-group">
    <label class="form-control-label">Take your face to verify</label>
<div class="d-flex justify-content-center">

    <div id="my_camera" style="width:320px; height:240px;"></div>
</div>
<br>
    <div class="profile-share d-flex align-items-center justify-content-center">
    <label href="javascript:;" class="btn btn-primary text-white border-0" id="btn_front_id" onclick="take_snapshot()">Take Snapshot</label>
    <input type="file" style="display: none" id="user_face" name="user_face" >
    </div>
    </div>
    
            <div class="d-grid">
                <label class="btn btn-primary btn-start border-0" id="btn_submit" disabled style="background: #6db2ee">Continue</label>
            </div>    </form> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js" integrity="sha512-dQIiHSl2hr3NWKKLycPndtpbh5iaHLo6MwrXm7F0FM5e+kL2U16oE9uIwPHUl6fQBeCthiEuV/rzP3MiAB8Vfw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
Webcam.attach( '#my_camera' );
var camera_id = document.querySelector('#my_camera');
function take_snapshot() {
    Webcam.snap( function(data_uri) {
        var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
        urltoFile(data_uri, 'name.jpg','text/plain').then(function(file){
            loading_cccd(data_uri)
        const formData = new FormData()
        formData.append('file[]',file)
        formData.append('file[]',DataURIToBlob('data:image/jpeg;base64,{{$base64}}'),'cccd.jpg')
        fetch('https://api.fpt.ai/dmp/checkface/v1',{
            method: 'POST',
            headers: {
                'api_key': 'BNvTJhvPdCDnUNsm0qgG9KmWpKVAAXQl'
              },
            body: formData
        }).then(res => res.json()).then(data => {
            if(data['data']['isMatch']) {
                sendImage(file)
                success_cccd()
            }
            else {
                fail_cccd()
            }
        })
    })
    })
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
function DataURIToBlob(dataURI) {
        const splitDataURI = dataURI.split(',')
        const byteString = splitDataURI[0].indexOf('base64') >= 0 ? atob(splitDataURI[1]) : decodeURI(splitDataURI[1])
        const mimeString = splitDataURI[0].split(':')[1].split(';')[0]

        const ia = new Uint8Array(byteString.length)
        for (let i = 0; i < byteString.length; i++)
            ia[i] = byteString.charCodeAt(i)

        return new Blob([ia], { type: mimeString })
      }
      function loading_cccd(data_uri) {
    camera_id.innerHTML = '<div class="cccd_img_parent"><img src="'+data_uri+'" class="user_image" /><div class="spinner-border mb-2" id="loader" style="color: #f66962;" role="status"><span class="visually-hidden">Loading...</span></div> </div>';


}
const btn_id = document.querySelector('#btn_submit');
function success_cccd() {
    document.querySelector('.user_image').style.border = '5px solid #00e676';
    document.querySelector('#loader').style.display = 'none';
    btn_id.style.background = '#fc7f50'
       let btn_verify = document.querySelector('#btn_front_id');
        const successStyle = {
            background: '#159f46',
            color: 'white',
            border: 'none',
                            }
        Object.assign(btn_verify.style, successStyle)
        btn_verify.innerHTML = 'Verified Successfully';
        btn_id.disabled = false;
        setTimeout(() => {
            location.reload()
        },1000)
}
function fail_cccd() {
    document.querySelector('.user_image').style.border = '5px solid #f66962';
    document.querySelector('#loader').style.display = 'none';
        setTimeout(() => {
            camera_id.innerHTML = ' <div id="my_camera" style="width:320px; height:240px;"></div>'
            Webcam.attach('#my_camera');
        }, 1000);
                
}
function sendImage(file) {
    let formData = new FormData();
    formData.append('user_face',file)
    fetch("{{route('mentor-face-verify')}}",{
            method: 'POST',
            body: formData
        }).then(res => res.text()).then(data => {
            if(data ==1) {
                btn_id.onclick = () => location.href = `{{route('mentor-success')}}`
            }
        })
       
}
</script>
@endsection