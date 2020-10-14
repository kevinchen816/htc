<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Storage;
use App\Models\Photo;

class FileDelete implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $year;
    protected $month;
    protected $day;
    protected $limit;

    /*
        Add below line in Job class and your job run without time out,
        even if you put the job in a crontab entry
    */
    // public $timeout = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($year, $month, $day, $limit)
    {
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
        $this->limit = $limit;
    }

    public function deleteGalleryFile_S3($filename) {
        $filename = 'media/'.$filename;
        Storage::disk('s3')->delete($filename);

        // $exists = Storage::disk('s3')->exists($filename);
        // if ($exists) {
        //     Storage::disk('s3')->delete($filename);
        // }
    }

    public function deleteGalleryFile_OSS($filename) {
        $filename = 'media/'.$filename;
        // OSS::publicDeleteObject(config('oss.bucketName'), $filename);
        Storage::disk('oss')->delete($filename);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $count = 0;
        $query = Photo::query();
        if ($this->year && $this->month && $this->day) {
            $date = $this->year.'-'.$this->month.'-'.$this->day;
            $query->whereDate('created_at', $date);
            // $query->whereDate('created_at', '<=', $date);
        } else {
            if ($this->year) {
                $query->whereYear('created_at', '=', $this->year);
            }
            if ($this->month) {
                $query->whereMonth('created_at', '=', $this->month);
            }
            if ($this->day) {
                $query->whereDay('created_at', '=', $this->day);
            }
        }
        $query->orderBy('id', 'asc'); // asc, desc
        if ($this->limit != 0) {
            $query->limit($this->limit);
        }
        $photos = $query->get();
        foreach ($photos as $photo) {
            if ($photo->camera_id != 10) {
                // app(CamerasController::class)->deleteGalleryFile($photo);
                if (env('APP_STORAGE') == 'AWS_S3') { //if (env('S3_ENABLE')) {
                    $this->deleteGalleryFile_S3($photo->id.'.JPG');
                    $this->deleteGalleryFile_S3($photo->id.'_thumb.JPG');
                    if ($photo->uploadtype == 4) {
                        $this->deleteGalleryFile_S3($photo->id.'.MP4');
                    }
                } else if (env('APP_STORAGE') == 'ALI_OSS') {
                    $this->deleteGalleryFile_OSS($photo->id.'.JPG');
                    $this->deleteGalleryFile_OSS($photo->id.'_thumb.JPG');
                    if ($photo->uploadtype == 4) {
                        $this->deleteGalleryFile_OSS($photo->id.'.MP4');
                    }
                } else {

                }

                // DB::table("photos")->where('id', '=', $photo->id)->delete();
                Photo::find($photo->id)->delete();
            }
        }
    }
}