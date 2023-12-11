<?php

namespace App\Jobs;

use Google\Cloud\Storage\StorageClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// use Illuminate\Support\Facades\Http;

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

        $storage = new StorageClient([
            'keyFilePath' => __DIR__ . '\..\..\kiou_bucket_key.json',
        ]);
        $bucketName = 'kiou_lesson';

        $bucket = $storage->bucket($bucketName);

        $bucket->upload(fopen(storage_path('app\public\videos\\' . $this->fileName), 'r'), ['name' => $this->mentorId . '/' . $this->course_id . '/' . $this->fileName]);

        // Http::asForm()->post('http://127.0.0.1:8000/api/convertVideo', [
        //     'url' => 'https://storage.googleapis.com/' . $bucketName . '/' . $this->mentorId . '/' . $this->course_id . '/' . $this->fileName,
        //     'name' => str_replace('.mp4', '', $this->fileName),

        // ]);

    }
}
