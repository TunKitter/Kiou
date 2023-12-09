<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Mentor;
use App\Models\Profession;
class Header extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $courses_awaiting= Course::where('state','-1')->get();
       
        return view('components.admin.header',compact('courses_awaiting'));
    }
}
