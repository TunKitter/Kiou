<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Dreams LMS</title>

<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.svg')}}">

<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/css/feather.css')}}">

<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}">

<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
<body>
<fieldset class="field-card">
<div class="add-course-info">
<div class="add-course-inner-header">
<h4>Requirements</h4>
</div>
<div class="add-course-form">
<form action="#" onsubmit="return hihi()">
<div class="form-group form-group-tagsinput">
<input type="text" data-role="tagsinput" class="input-tags form-control" name="html" value="jquery, bootstrap" id="html" >
<input type="text" id="haha">
</div>
<select class="form-select select" id="sel1" name="sellist1" onchange="demo(this)">
<option value="demo1" > published 1</option>
<option value="demo2" > published 2</option>
<option value="demo3" > published 3</option>
<option value="demo4" > published 4</option>
<option value="demo5" > published 5</option>
<option value="demo6" > published 6</option>
<option value="demo7" > published 7</option>
<option value="demo8" > published 8</option>
<option value="demo9" > published 9</option>
<option value="demo10" > published 10</option>
<option value="demo11" > published 11</option>
<option value="demo12" > published 12</option>
<option value="demo13"> published 13</option>
</select>
</form>
</div>
<div class="widget-btn">
<a class="btn btn-black prev_btn">Previous</a>
<button class="btn btn-info-light next_btn" onclick="hihi()">Continue</button>
</div>
</div>
</fieldset>
</footer>

</div>
<script>
const json = {}
    function demo(obj) {
        document.querySelector('input').value+= document.querySelector(`option[value=${obj.value}]`).innerHTML
        json[obj.value] = document.querySelector(`option[value=${obj.value}]`).innerHTML
        document.querySelector('input').click()
        document.querySelector('#haha').value += ',' + obj.value
    }
    function hihi() {
         document.querySelector('input').value.split(', ').foreach(e => {
            console.log(json[e.trim()]);
            return false
         })
    }
</script>

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>

<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>

<script src="{{asset('assets/js/ckeditor.js')}}"></script>

<script src="{{asset('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js')}}"></script>

<script src="{{asset('assets/js/script.js')}}"></script>

</body>
</html>