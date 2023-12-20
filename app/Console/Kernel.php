<?php

namespace App\Console;

use App\Models\Course;
use App\Models\Mentor;
use App\Models\Profession;
use App\Models\Roadmap;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Cache;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            Cache::put('total_course', Course::count());
            Cache::put('total_mentor', Mentor::count());
            Cache::put('total_roadmap', Roadmap::count());
            Cache::put('total_enrollment', Course::sum('total_enrollment'));
            $top10Professions = Course::select(['category'])->get()->toArray();
            $top10ProfessionsResult = [];
            foreach ($top10Professions as $key => $value) {
                $top10ProfessionsResult[$value['category']]['quantity'] = (isset($top10ProfessionsResult[$value['category']]['quantity'])) ? $top10ProfessionsResult[$value['category']]['quantity'] += 1 : 1;
            }
            $profession_name = (Profession::whereIn('_id', array_keys($top10ProfessionsResult))->get()->pluck('name', '_id'));
            foreach ($top10Professions as $key => $value) {
                $top10ProfessionsResult[$value['category']]['name'] = $profession_name[$value['category']];
            }
            \usort($top10ProfessionsResult, function ($a, $b) {
                return $b['quantity'] <=> $a['quantity'];
            });
            Cache::put('top10_profession', $top10ProfessionsResult);
            $mentor_with_total_enrollment_and_avatar = (Course::raw(function ($collection) {
                return $collection->aggregate([
                    ['$group' => [
                        '_id' => '$mentor_id',
                        'total_enrollment' => ['$sum' => '$total_enrollment'],
                    ]],
                ]);
            }));
            $mentor_name = (Mentor::whereIn('_id', $mentor_with_total_enrollment_and_avatar->pluck('_id')->toArray())->get());
            $mentor_name_with_id = $mentor_name->pluck('name', '_id')->toArray();
            $mentor_name_with_image = $mentor_name->pluck('image.avatar', '_id')->toArray();
            $professions = [];
            foreach ($mentor_with_total_enrollment_and_avatar as $key => $value) {
                $mentor_with_total_enrollment_and_avatar[$key]->mentor_name = $mentor_name_with_id[$value['_id']];
                $mentor_with_total_enrollment_and_avatar[$key]->mentor_image = $mentor_name_with_image[$value['_id']];
                $mentor_with_total_enrollment_and_avatar[$key]->mentor_professions = $mentor_name->toArray()[$key]['profession'];
                $professions = [...$professions, ...$mentor_name->toArray()[$key]['profession']];
            }
            $professions_name = (Profession::whereIn('_id', $professions)->get()->pluck('name', '_id')->toArray());
            Cache::put('mentor_with_total_enrollment_and_avatar', $mentor_with_total_enrollment_and_avatar);
            Cache::put('professions_name', $professions_name);
        })->everyTenSeconds();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
