<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Enrollment;
use App\Models\IdCard;
use App\Models\Mentor;
use App\Models\Course;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MentorController extends Controller
{
    public function overview()
    {
        return view('client.mentor.overview');
    }
    public function register()
    {
        $mentor_check = Mentor::where('user_id', auth()->id())->first();
        if ($mentor_check) {
            if ($mentor_check->name || $mentor_check->profession) {
                return redirect()->route('mentor-upload-id-card');
            }
        }
        $data = (((Profession::select('id', 'name')->get())));
        return view('client.mentor.register', ['professions' => (implode(',', $data->pluck('name')->toArray())), 'id_professions' => (implode(',', $data->pluck('id')->toArray())), 'data' => $data]);
    }
    public function handleRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:2', 'max:40', 'regex:/[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]+$/'],
            'username' => ['required', 'string', 'min:3', 'alpha_dash:ascii', Rule::unique('mentors')],
        ],
            [
                'name.required' => 'Vui lòng nhập tên.',
                'name.min' => 'Tên ít nhất phải :min ký tự!',
                'name.max' => 'Tên không được vượt quá :max ký tự!',
                'name.regex' => 'Tên không được chứa ký tự đặc biệt!',
                'username.required' => 'Vui lòng nhập tên đăng nhập.',
                'username.min' => 'Tên đăng nhập phải chứa ít nhất :min ký tự!',
                'username.alpha_dash' => 'Tên đăng nhập không được chứa ký tự đặc biệt!',
                'username.unique' => 'Tên đăng nhập đã có người dùng!',
            ]);
        Mentor::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'username' => $request->username,
            'profession' => explode(',', $request->profession),
        ]);

        return redirect()->route('mentor-upload-id-card');
    }

    public function handleProfile(ProfileRequest $request)
    {
        // dd($request->all());
        $request->validated();
        $update_data = [];
        $request->name ? $update_data['name'] = $request->name : '';
        $request->username ? $update_data['username'] = $request->username : '';
        $request->profession ? $update_data['profession'] = explode(',', $request->profession) : '';
        $user = Auth::user();

        if ($request->avatar) {
            $imagePath = \uniqid() . '.' . $request->file('avatar')->getClientOriginalExtension();
            $this->upload_file($imagePath, public_path('mentor/avatar'), $request->file('avatar'), true, auth()->user()->mentor->image['avatar']);
            $update_data['image.avatar'] = $imagePath;

        }
        if (!(Mentor::where('username', $request->username)->count())) {
            Mentor::where('user_id', $user->id)->update($update_data);
            return redirect()->route('mentor-profile')->with('success', 'Thông tin đã được cập nhật thành công.');
        } else {
            return redirect()->route('mentor-profile')->with('already_username', 'Tên người dùng đã tồn tại');
        }
    }
    public function profile()
    {
        if (!Auth::user()->mentor) {
            return redirect()->route('mentor-overview');
        }
        if (!(Auth::user()->mentor->image['front_card'] && Auth::user()->mentor->image['back_card'] && Auth::user()->mentor->image['user_face'])) {
            return redirect()->route('mentor-register');
        }
        $mentor = Mentor::where('user_id', Auth::id())->first();
        $professions = Profession::all();
        $mentor_professions = array_map(function ($profession_id) use ($professions) {
            return array_filter($professions->toArray(), function ($profession) use ($profession_id) {
                return $profession['_id'] == $profession_id;
            });
        }, $mentor->toArray()['profession']);
        $mentor_professions = implode(',', array_map(function ($profession) {
            return $profession[array_key_first($profession)]['name'];
        }, $mentor_professions));
        return view('client.mentor.profile', compact('mentor', 'professions', 'mentor_professions'));
    }
    public function uploadIdCard(Request $request)
    {
        $mentor_check = Mentor::where('user_id', auth()->id())->first();
        if ($mentor_check) {
            if ($mentor_check->image['front_card'] && $mentor_check->image['back_card']) {
                return redirect()->route('mentor-face-verify');
            }
        }
        return view('client.mentor.id-card-upload', ['is_already' => $request->already ? 1 : 0]);
    }
    public function takingPicture(Request $request)
    {
        $mentor_check = Mentor::where('user_id', auth()->id())->first();
        if ($mentor_check) {
            if ($mentor_check->image['front_card'] && $mentor_check->image['back_card']) {
                return redirect()->route('mentor-face-verify');
            }
            return view('client.mentor.online-take-picture-id-card-confirm', ['is_already' => $request->already ? 1 : 0]);
        }
    }

    public function handleUploadIdCard(Request $request)
    {
        $front_card_name = uniqid() . '.' . $request->file('front_card')->getClientOriginalExtension();
        $back_card_name = uniqid() . '.' . $request->file('back_card')->getClientOriginalExtension();
        $request->front_card->move(storage_path('app/mentor/cccd'), $front_card_name);
        $request->back_card->move(storage_path('app/mentor/cccd'), $back_card_name);
        Mentor::where('user_id', auth()->id())->first()->update([
            'image.front_card' => $front_card_name,
            'image.back_card' => $back_card_name,
        ]);
        return redirect()->route('mentor-face-verify');
    }
    public function faceVerify()
    {
        if (!(auth()->user()->mentor->image['front_card'] && auth()->user()->mentor->image['back_card'])) {
            return redirect()->route('mentor-upload-id-card');
        }
        if (auth()->user()->mentor->image['user_face']) {
            return \redirect()->route('mentor-success');
        }

        $filePath = (Storage::get('mentor/cccd/' . auth()->user()->mentor->image['front_card']));
        $base64 = base64_encode($filePath);
        return view('client.mentor.verify-face', compact('base64'));
    }
    public function handleFaceVerify(Request $request)
    {

        if ($request->user_face) {
            $fileName = uniqid() . '.' . $request->file('user_face')->getClientOriginalExtension();
            auth()->user()->mentor->update([
                'image.user_face' => $fileName,
            ]);
            $this->upload_file($fileName, storage_path('app/mentor/face'), $request->file('user_face')
            );
        }
        return 1;
    }
    public function deleteAvatar()
    {
        if (!auth()->user()->mentor->image['avatar']) {
            unlink(\public_path('mentor/avatar/' . auth()->user()->mentor->image['avatar']));
            auth()->user()->mentor->update(['image.avatar' => 'avatar.jpg']);
        }
        return 1;
    }
    public function success()
    {
        return view('client.mentor.success');
    }
    public function saveIdCardData(Request $request)
    {
        if (IdCard::where('id', $request->id)->exists()) {
            return 0;
        }

        IdCard::create(array_merge(['mentor_id' => auth()->user()->mentor->id], $request->all()));
        return 1;

    }

    public function dashboard () {
        if (!Auth::user()->mentor) {
            return redirect()->route('mentor-overview');
        }
        if (!(Auth::user()->mentor->image['front_card'] && Auth::user()->mentor->image['back_card'] && Auth::user()->mentor->image['user_face'])) {
            return redirect()->route('mentor-register');
        }
        $mentor = Mentor::where('user_id', Auth::id())->first();
        $professions = Profession::all();
        $mentor_professions = array_map(function ($profession_id) use ($professions) {
            return array_filter($professions->toArray(), function ($profession) use ($profession_id) {
                return $profession['_id'] == $profession_id;
            });
        }, $mentor->toArray()['profession']);
        $mentor_professions = implode(',', array_map(function ($profession) {
            return $profession[array_key_first($profession)]['name'];
        }, $mentor_professions));
        
        // Earning this month and STUDENTS ENROLLMENTS
        $targetMonth= Carbon::now()->month;

        $courses_mentor = Course::where('mentor_id',Auth::user()->mentor->_id)->get();
        $arr = [];
        foreach($courses_mentor as $course_mentor ) {
           $arr[] = $course_mentor->_id;
        }
       
       
       $enrollments_course = Enrollment::whereIn('course_id',$arr)
                        ->where('state', '65347ec024cfaf917eaad1b1')
                        ->whereMonth('created_at',  $targetMonth)
                        ->get();

        $instructorRevenue = 0;
        $studentsEnrollment= [];
        foreach ($enrollments_course as $enrollment) {
                $studentsEnrollment[] =$enrollment->user_id;
                $instructorRevenue += $enrollment->price['course'];
        }
        // Earnings

        $earnings_instructor = Enrollment::whereIn('course_id',$arr)
                ->where('state', '65347ec024cfaf917eaad1b1')
                ->whereYear('created_at', date('Y'))
                ->groupBy('created_at', 'price')
                ->get();
        $index = 0;
        $array =array_fill(0, 12, 0);
       
        array_map(function($item) use(&$array,&$index,$earnings_instructor) {

                $temp_price = ($earnings_instructor[$index]->price);

                if(strpos($temp_price['sale'],'_')!== false) {
                      $price = $temp_price['course'] - ($temp_price['course']/100) * explode('_',$temp_price['sale'])[1];
                } else {
                      $price = $temp_price['course'] - $temp_price['sale'];
                }

                $array[((int) date('m',$earnings_instructor[$index]->created_at->timestamp))-1]+= $price;

                $index++;
        }, $earnings_instructor->toArray());

        $earnings = (implode(',', $array));   

        // Ranting
        $total_rate = 0;
        $courses_ratting = 0; 
        foreach ($courses_mentor as $course){
            $rates [] = $course->complete_course_rate;
        
            $courses_ratting = ($total_rate += $course->complete_course_rate)/count($rates);
        }

        // Best courses
        $courses = Course::where('mentor_id',Auth::user()->mentor->_id)
                            ->orderBy('total_enrollment', 'desc')
                            ->limit(10)
                            ->get();

        $best_courses = [0,0,0,0,0,0,0,0,0,0];
        $courses_name =  ["","","","","","","","","",""];
        $best_courses_index = 0;
        foreach( $courses as $courses) {
           $best_courses[$best_courses_index] = $courses->total_enrollment;
           $courses_name[$best_courses_index] = $courses->name;
           $best_courses_index++;
        }
    
        $best_courses = (implode(',', $best_courses));
      
        return view('client.mentor.dashboard', compact('mentor', 'professions', 'mentor_professions', 'instructorRevenue', 'studentsEnrollment','earnings', 'courses_ratting','best_courses' , 'courses_name'));
        
    }
}
