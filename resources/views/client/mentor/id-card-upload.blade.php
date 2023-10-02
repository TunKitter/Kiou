@extends('client.layouts.mentor_auth')
@section('content')
@if($is_already ==1)
@include('client.section.message', ['type' => 'Fail','message' => 'The id card already uploaded your identify card'])
@endif
<div class="login-wrapper">
    <div class="loginbox">
        <div class="w-100">
            <div class="img-logo">
                <img src="{{asset('assets/img/logo.svg')}}" class="img-fluid" alt="Logo">

            </div>
            <h1>Upload your identify card</h1>
            <form action="{{route('mentor-upload-id-card')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-control-label">Front ID CARD</label>
                    <div class="profile-share d-flex align-items-center justify-content-center">
                        <label href="javascript:;" class="btn btn-primary text-white" for="front_id">Upload</label>
                        <input type="file" style="display: none" name="front_card" id="front_id" onchange="uploadImage(this,'front_id')">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Back ID CARD</label>
                    <div class="profile-share d-flex align-items-center justify-content-center">
                        <label href="javascript:;" class="btn btn-primary text-white" for="back_id">Upload</label>
                        <input type="file" name="back_card" style="display: none" id="back_id" onchange="uploadImage(this,'back_id')">
                    </div>
                </div>
                <div class="spinner-border mb-2" id="loader" style="color: #f66962;display: none" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
        </div>
        <div class="professions">
        </div>
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
            <button class="btn btn-primary btn-start" id="btn_submit" disabled>Đăng ký mentor</button>
            <br>
            <a class="link-secondary" href="{{route('mentor-taking-picture')}}">Hoặc chụp trực tiếp tại đây</a>
        </div>
        </form>

    </div>
</div>
</div>
<script>
    var is_both_uploaded = [false,false]
    var loader = document.querySelector('#loader')
    var professions = document.querySelector('.professions')
    const FPT_API_KEY = 'MsdkyC6BhNBhmcvCFpmaStvNM9D35155'
    const btn_submit = document.querySelector('#btn_submit')
    const FPT_API_ENDPOINT = 'https://api.fpt.ai/vision/idr/vnm'
    var id_infor = document.querySelector('.id-infor')
    var data_form = new FormData()

    function uploadImage(input, label_id) {
        let temp_label = document.querySelector('label[for=' + label_id + ']')
        temp_label.innerHTML = 'Uploading...'
        temp_label.style.background = '#ed9c7e'
        loader.style.display = 'block'
        const formData = new FormData();
        formData.append('image', document.querySelector('#' + label_id).files[0]);
        fetch(FPT_API_ENDPOINT, {
            method: 'POST',
            headers: {
                'api_key': FPT_API_KEY
            },
            body: formData
        }).then(res => res.json())
            .then(data => {
                let error_code = data['errorCode'] == 1 ? 0 : data['errorCode']
                switch (error_code) {
                    case 0: {
                        let result_id = data['data'][0]
                  
                   
                        if (label_id == 'front_id') {
                        for(let key in result_id) {
                            if(key != 'address_entities') 
                            {
                                data_form.append(key, result_id[key])                                
                            }
                        }
                            if (!(result_id['id'] && result_id['name'] && result_id['dob'] && result_id['address'])) {
                                document.querySelector('#front_id').value = ''
                                temp_label.innerHTML = 'Invalid image, Please try again'
                                temp_label.style.background = '#f66962'
                                loader.style.display = 'none'
                            }
                            else {
                                const successStyle = {
                                    background: '#159f46',
                                    color: 'white',
                                    border: 'none',
                                }
                                Object.assign(temp_label.style, successStyle)
                                temp_label.innerHTML = 'Success';
                                document.querySelector('#id_card_infor').innerHTML = result_id['id']
                                document.querySelector('#name_card_infor').innerHTML = result_id['name']
                                document.querySelector('#valid_date_card_infor').innerHTML = result_id['dob']
                                document.querySelector('#id_card_address').innerHTML = result_id['address']
                                id_infor.style.display = 'block'
                                loader.style.display = 'none'
                                is_both_uploaded[0]= true
                                is_disable_button()
                                document.querySelector('label[for=front_id]').onclick = () => {
                                    location.reload()
                                }

                            }
                        }
                        else {
                            let errr_code = data['errorCode'] == 1 ? 0 : data['errorCode']
                            console.log(data['errorCode'],error_code);
                            switch (errr_code) {
                                case 0: {
                                    if(!data['data'][0]['issue_loc']) {
                                        document.querySelector('#back_id').value = ''
                                temp_label.innerHTML = 'Invalid image, Please try again'
                                temp_label.style.background = '#f66962'     
                                loader.style.display = 'none'
                                    }
else {
                         for(let key in data['data'][0]) {
                                data_form.append(key, data['data'][0][key])                                
                        }
                              document.querySelector('#where_card_infor').style.display = 'block'
                                    document.querySelector('#where_card_infor').innerHTML += '<b>' + data['data'][0]['issue_loc'] + '</b>'
                                    loader.style.display = 'none'
                                    const successStyle = {
                                        background: '#159f46',
                                        color: 'white',
                                        border: 'none',
                                    }
                                    Object.assign(temp_label.style, successStyle)
                                    temp_label.innerHTML = 'Success';
                                    is_both_uploaded[1] = true
                                    is_disable_button()
                                    document.querySelector('label[for=back_id]').onclick = () => {
                                        location.reload()
                                    }
                                }
                                break
                                }
                                case 1: {
                                    error_id('Invalid Back ID Card')
                                    break
                                }
                                case 2: {
                                    error_id('Something went wrong')
                                    break
                                }
                            }
                            break;

                        }
break;
                    }

                    case 1: {
                        error_id('Invalid Front ID Card')
                        break
                    }
                    default: {
                        error_id('Something went wrong')
                        break
                    }


                }


            })
    }
    function error_id(message) {
        loader.style.display = 'none'
        id_infor.style.display = 'block'
        id_infor.innerHTML = `<p class="text-red-500">${message}</p>`
        setTimeout(() => {
            location.reload()
        }, 2000);
    }
    function is_disable_button() {
        if(is_both_uploaded[0] && is_both_uploaded[1]) {
            btn_submit.removeAttribute('disabled')
            fetch("{{route('mentor-save-id-card')}}", {
                            method: 'POST',
                            body: data_form
                        }).then(res => res.text()).then(data => {
                            console.log(data);
                            
                            if(data == 0) {
                                location.href = location.href + '?already=1'
                            }
                        })
        }
    }
</script>
<script src="https://cdn.tailwindcss.com"></script>

@endsection