<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UploadVideoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    //  protected $path;
    protected $fileName;
    protected $mentorId;
    protected $course_id;
    public function __construct($mentorId, $course_id, $fileName, )
    {
        // $this->path = $path;
        $this->mentorId = $mentorId;
        $this->course_id = $course_id;
        $this->fileName = $fileName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //  Upload to google

        // $storage = new StorageClient([
        // 'keyFilePath' => __DIR__ . '\..\..\kiou_bucket_key.json',
        // ]);
        $bucketName = 'kiou_lesson';

        // $bucket = $storage->bucket($bucketName);

        // $bucket->upload(fopen(storage_path('app\public\videos\\' . $this->fileName), 'r'), ['name' => $this->mentorId . '/' . $this->course_id . '/' . $this->fileName]);
        // Http::asForm()->post('https://convertvideo-53e577e37e4e.herokuapp.com/api/convertVideo', [
        // 'url' => $this->mentorId . '/' . $this->course_id . '/' . $this->fileName,
        // 'name' => 'stream/' . $this->mentorId . '/' . $this->course_id . '/' . $this->fileName,
        // ]);
    }
}
