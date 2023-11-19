@extends('client.layouts.master')
@section('content')
<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="tak-instruct-group">
                    <div class="row">
                        <div class="col-md-12">
                            {{-- <div class="settings-widget">
                                <div class="settings-inner-blk p-0">
                                    <div class="sell-course-head comman-space">
                                        <h3>Common CP</h3>
                                        <p>Common Coing Practice as suitable for you</p>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="settings-widget">
                                <div class="settings-inner-blk p-0">
                                    <div class="comman-space pb-0">
                                        <div class="sell-course-head withdraw-history-head border-bottom-0">
                                            {{-- <h3>Withdraw History</h3> --}}
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <form action="#" onsubmit="return false">
                                                    <div class="row gx-2 align-items-center">
                                                        <div class="col-md-6 col-lg-3 col-item">
                                                            <div class="form-group select-form mb-0">
                                                                <select class="form-select border-secondary" name="level">
                                                                    @foreach ($levels as $key => $level)
                                                                        <option value="{{$key}}">{{$level}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-3 col-item">
                                                            <div class="form-group select-form mb-0">
                                                                <select class="form-select border-secondary" name="profession" onchange="filterData(this.value)" >
                                                                    @foreach ($profession_name as $key => $profession)
                                                                        <option value="{{$key}}">{{$profession}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-item">
                                                            <div class="form-group select-form mb-0">
                                                                <select class="form-select border-secondary"  name="category"  >
                                                                    @foreach ($category_name as $key => $category)
                                                                        <option value="{{$key}}" id="{{$category_profession[$key]}}">{{$category}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>  
                                                            <div class="col-md-3 col-lg-3 col-item" id="category">
                                                            <button class="btn btn-primary ms-5" onclick="searchData(this)">Search</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comman-space pb-0">
                                        <div class="settings-referral-blk course-instruct-blk  table-responsive">

                                            <table class="table table-nowrap mb-0">
                                                <thead style="background:#f0f0f0 ">
                                                    <tr>
                                                        <th>Requirement</th>
                                                        <th>Mentor Name</th>
                                                        <th>Category</th>
                                                        <th>Level</th>
                                                        <th>Apply</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($mentor_asm as $mentor)
                                                    <tr>
                                                         <td><a href="view-invoice.html">{{$mentor['description']}}</a></td>
                                                         <td>{{$mentor_name[$mentor['mentor_id']]}}</td>
                                                         <td>{{$category_name[$mentor['category_id']]    }}</td>
                                                         <td>{{$levels[$mentor['level_id']]}}</td>
                                                         <td><span class="btn btn-primary" onclick="saveData('{{$mentor['_id']}}',this)">Apply now</span></td>
                                                     </tr> 
                                                     @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@include('client.section.loading')
<script>
const level = document.querySelector('select[name="level"]');
const category = document.querySelector('select[name="category"]');
const profession = document.querySelector('select[name="profession"]');
     function filterData(_id) {
        $('select[name="category"] option').hide(); 
         $('select[name="category"] option[id="'+_id+'"]').show();
        // $('select[name="category"]').prop("selectedIndex", 0);
        // $('select[name="category"] :not(option[style*="display: none"])').attr('selected','selected');
        $('select[name="category"]').val('')

      }
function searchData(obj) {
    if(level.value  && category.value  && profession.value ) {
        obj.disabled = true;
        obj.innerHTML = 'Searching...';
        document.querySelector('tbody').innerHTML = '<td id="parent_loading"><div id="loading" style="display: block;"></div></td>';
        let formData = new FormData();
        formData.append('level', level.value);
        formData.append('category', category.value);
        formData.append('profession', profession.value);
        fetch('{{ route("revision-code-explore-list")}}',{
            method: 'POST',
            body: formData
        }).then(res => res.json()).then(data => {
            console.log(data);
            mentor_asm_key = Object.keys(data.mentor_asm);
            if(mentor_asm_key.length == 0) {
            document.querySelector('tbody').innerHTML = `<td><span class="text-muted">No result found</span></td>`;
            }
            else {
             for (let i = 0; i < mentor_asm_key.length; i++) {
                document.querySelector('tbody').innerHTML += `<tr><td><a href="view-invoice.html">${data.mentor_asm[mentor_asm_key[i]]['description']}</a></td><td>${data.mentor_name[data.mentor_asm[mentor_asm_key[i]]['mentor_id']]}</td><td>${data.category_name[data.mentor_asm[mentor_asm_key[i]]['category_id']]}</td><td>${data.levels[data.mentor_asm[mentor_asm_key[i]]['level_id']]}</td><td><span class="btn btn-primary" onclick="saveData('${mentor_asm_key[i]}',this)">Apply now</span></td></tr>`
            }               
            }
            // document.querySelector('tbody').innerHTML = `<td>${data.status}</td>`;
            obj.innerHTML = 'Search';
            obj.disabled = false;
            document.querySelector('#parent_loading').style.display = 'none';
        });
    }
}
function saveData(_id,obj) {
    obj.classList.add('disabled');
    obj.innerHTML = 'Saving...';
    let formData = new FormData()
    formData.append('assignment', _id)
    fetch('{{route("revision-code-explore-save")}}',{
        method: 'POST',
        body: formData
    }).then(res => res.json()).then(data => {
        obj.innerHTML = 'Saved';
    })
}
</script>
@endsection