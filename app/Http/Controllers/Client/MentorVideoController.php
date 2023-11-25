<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Level;
use App\Models\Mentor;
use App\Models\MentorAssignment;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class MentorVideoController extends Controller
{
    public function create()
    {
        $professions = Profession::all();
        $levels = Level::all();
        return view('client.courses.create-course', compact('professions', 'levels'));
    }
    public function dashboard()
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

        // Earning this month and STUDENTS ENROLLMENTS
        $targetMonth = Carbon::now()->month;

        $courses_mentor = Course::where('mentor_id', Auth::user()->mentor->_id)->get();
        $arr = [];
        foreach ($courses_mentor as $course_mentor) {
            $arr[] = $course_mentor->_id;
        }

        $enrollments_course = Enrollment::whereIn('course_id', $arr)
            ->where('state', '65347ec024cfaf917eaad1b1')
            ->whereMonth('created_at', $targetMonth)
            ->get();

        $instructorRevenue = 0;
        $studentsEnrollment = [];
        foreach ($enrollments_course as $enrollment) {
            $studentsEnrollment[] = $enrollment->user_id;
            $instructorRevenue += $enrollment->price['course'];
        }
        // Earnings

        $earnings_instructor = Enrollment::whereIn('course_id', $arr)
            ->where('state', '65347ec024cfaf917eaad1b1')
            ->whereYear('created_at', date('Y'))
            ->groupBy('created_at', 'price')
            ->get();
        $index = 0;
        $array = array_fill(0, 12, 0);

        array_map(function ($item) use (&$array, &$index, $earnings_instructor) {

            $temp_price = ($earnings_instructor[$index]->price);

            if (strpos($temp_price['sale'], '_') !== false) {
                $price = $temp_price['course'] - ($temp_price['course'] / 100) * explode('_', $temp_price['sale'])[1];
            } else {
                $price = $temp_price['course'] - $temp_price['sale'];
            }

            $array[((int) date('m', $earnings_instructor[$index]->created_at->timestamp)) - 1] += $price;

            $index++;
        }, $earnings_instructor->toArray());

        $earnings = (implode(',', $array));

        // Ranting
        $total_rate = 0;
        $courses_ratting = 0;
        foreach ($courses_mentor as $course) {
            $rates[] = $course->complete_course_rate;

            $courses_ratting = ($total_rate += $course->complete_course_rate) / count($rates);
        }

        // Best courses
        $courses = Course::where('mentor_id', Auth::user()->mentor->_id)
            ->orderBy('total_enrollment', 'desc')
            ->limit(10)
            ->get();

        $best_courses = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $courses_name = ["", "", "", "", "", "", "", "", "", ""];
        $best_courses_index = 0;
        foreach ($courses as $courses) {
            $best_courses[$best_courses_index] = $courses->total_enrollment;
            $courses_name[$best_courses_index] = $courses->name;
            $best_courses_index++;
        }

        $best_courses = (implode(',', $best_courses));

        return view('client.mentor.dashboard', compact('mentor', 'professions', 'mentor_professions', 'instructorRevenue', 'studentsEnrollment', 'earnings', 'courses_ratting', 'best_courses', 'courses_name'));

    }
    public function uploadResumable(Request $request)
    {
        //save a file into public folder in laravl

        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            return response()->json([
                'status' => false,
                'message' => 'No file was uploaded.',
            ]);
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

            $disk = Storage::disk('public');
            $path = $disk->putFileAs('videos', $file, $fileName);

            // delete chunked file
            unlink($file->getPathname());
            return [
                'path' => asset('storage/' . $path),
                'filename' => $fileName,
            ];
        }

        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true,
        ];

    }
    public function handleUpload()
    {
        $random_content_path = \uniqid();
        File::put(public_path('course/overview/' . $random_content_path . '.json'), json_encode([
            'description' => request()->content,
            'requirements' => explode('_$_', request()->requirement),
            'objective' => explode('_$_', request()->will_learn),
        ]));
        $image_name = md5(uniqid() . \request()->image->getClientOriginalName()) . '.' . request()->image->getClientOriginalExtension();
        request()->image->move('course/thumbnail/', $image_name);
        $new_course = Course::create([
            'name' => request()->name,
            'description' => request()->description,
            'content_path' => $random_content_path . '.json',
            'category' => request()->category,
            'price' => request()->price,
            'image' => $image_name,
            'price' => request()->price,
            'meta.total_chapter' => request()->total_chapter,
            'meta.total_lesson' => request()->total_lesson,
            'meta.total_time' => request()->total_time,
            'slug' => Str::slug(request()->name),
            'mentor_id' => auth()->user()->mentor->_id,
            'level_id' => request()->level,
        ]);
        $chapter_infor = ['course_id' => $new_course->_id];
        foreach (explode('_$_', request()->chapters) as $item) {
            $chapter_infor['infor'][uniqid()] = $item;
        }
        Chapter::create($chapter_infor);
        return response()->json([
            'status' => true,
            'message' => 'OK',
        ]);
    }
    public function cp()
    {
        $mentor = auth()->user()->mentor;
        $asm = MentorAssignment::where('mentor_id', $mentor->_id)->get();
        $categories = Category::whereIn('_id', $asm->pluck('category_id'))->get()->pluck('name', '_id');
        $level = Level::whereIn('_id', $asm->pluck('level_id'))->get()->pluck('name', '_id');
        return view('client.mentor.cp', compact('mentor', 'asm', 'categories', 'level'));
    }
    public function cp_detail($id)
    {
        $code = (Storage::get('mentor_code/demo.js'));
        $mentor = auth()->user()->mentor;
        $asm = MentorAssignment::where('mentor_id', $mentor->_id)->where('_id', $id)->first();
        $categories = Category::all();
        $level = Level::all();
        $condition_code = '';
        foreach ($asm->condition_code as $key => $value) {
            $condition_code .= $key . '=' . $value . ' </br>';
        }
        return view('client.mentor.cp_detail', compact('mentor', 'asm', 'categories', 'level', 'code', 'condition_code'));
    }
    public function cp_update()
    {
        if (request()->base_code) {
            Storage::put('mentor_code/' . request()->name_file, request()->base_code);
            $condition_code = explode(',', request()->condition_code);
            $result = [];
            foreach ($condition_code as $pair) {
                list($key, $value) = explode(":", $pair);
                $result[$key] = trim($value);
            }
            MentorAssignment::find(request()->asm_id)->update(['condition_code' => $result]);
        } else {
            MentorAssignment::find(request()->id)->update(request()->only('description', 'level_id', 'category_id', 'condition_code'));
        }
        return response()->json([
            'status' => true,
            'message' => request()->all(),
        ]);
    }
    public function cp_create()
    {
        $mentor = auth()->user()->mentor;
        $categories = Category::all();
        $level = Level::all();
        return view('client.mentor.cp_create', compact('mentor', 'categories', 'level'));
    }
    public function handle_cp_create()
    {
        $file_name = uniqid() . '.js';
        Storage::put('mentor_code/' . $file_name, request()->base_code);
        $condition_code = explode(',', request()->condition_code);
        $result = [];
        foreach ($condition_code as $pair) {
            list($key, $value) = explode(":", $pair);
            $result[$key] = trim($value);
        }
        MentorAssignment::create([
            'mentor_id' => auth()->user()->mentor->_id,
            'category_id' => request()->category_id,
            'level_id' => request()->level_id,
            'description' => request()->description,
            'code_path' => $file_name,
            'condition_code' => $result,
        ]);
        return response()->json([
            'status' => true,
            'message' => request()->all(),
        ]);
    }
    public function cp_delete()
    {
        $result = MentorAssignment::find(request()->id);
        Storage::delete('mentor_code/' . $result->code_path);
        $result->delete();
        return response()->json([
            'status' => true,
            'message' => request()->all(),
        ]);
    }
}
