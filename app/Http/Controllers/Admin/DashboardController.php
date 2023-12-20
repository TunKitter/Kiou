<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Mentor;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Revenue

        // Total course menter
        $mentors = Mentor::with('course')->get(['name']);
        $name_mentors = [];
        $count_course_mentors = [];

        foreach ($mentors as $mentor) {
            $name_mentors[] = $mentor->name;
            $count_course_mentors[] = $mentor->course->count();
        }
        // Total month course and enrollment
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $total_month_course = [];
        $total_month_enrollment = [];
        foreach ($months as $month) {
            $courses = Course::whereMonth('created_at', $month)
                ->whereYear('created_at', date('Y'))
                ->get();
            $enrollments = Enrollment::where('state', '65347ec024cfaf917eaad1b1')
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', date('Y'))
                ->get();

            $total_month_course[$month] = $courses->count();
            $total_month_enrollment[$month] = $enrollments->count();
        }
        // Top 10 excellent mentors
        $total_enrollment_mentor = Course::raw(function ($collection) {
            return $collection->aggregate([
                ['$group' => [
                    '_id' => '$mentor_id',
                    'total_enrollment' => ['$sum' => '$total_enrollment'],
                    'total_revenue' => ['$sum' => ['$multiply' => ['$price', '$total_enrollment']]],
                ]],
                ['$sort' => ['total_enrollment' => -1]],
                ['$limit' => 10],
            ]);
        });
        return view('admin.dashboard', compact('name_mentors', 'count_course_mentors', 'total_month_course', 'total_month_enrollment', 'total_enrollment_mentor'));
    }
    public function getInfor($type)
    {
        switch ($type) {
            case 'user':
                return response()->json([
                    'total_user' => User::count(),
                ]);
                break;
            case 'course':{
                    return response()->json([
                        'total_course' => Course::count(),
                    ]);
                    break;
                }
            case 'order':{
                    return response()->json([
                        'total_order' => Enrollment::where('state', '65347ec024cfaf917eaad1b1')->count(),
                    ]);
                    break;
                }
            case 'order':
                return response()->json([
                    'total_order' => Enrollment::where('state', '65347ec024cfaf917eaad1b1')->count(),
                ]);
                break;
            case 'revenue':{
                    $enrollments = Enrollment::where('state', '65347ec024cfaf917eaad1b1')->get();
                    $total_revenue = 0;

                    foreach ($enrollments as $enrollment) {

                        if (empty($enrollment->price['sale'])) {
                            $price = $enrollment->price['course'];
                        } else if (strpos($enrollment->price['sale'], '_') !== false) {

                            $price = $enrollment->price['course'] - ($enrollment->price['course'] / 100) * explode('_', $enrollment->price['sale'])[1];
                        } else {
                            $price = $enrollment->price['course'] - $enrollment->price['sale'];
                        }
                        $total_revenue += $price;
                    }
                    return response()->json([
                        'total_revenue' => $total_revenue,
                    ]);
                }
        }
    }
}
