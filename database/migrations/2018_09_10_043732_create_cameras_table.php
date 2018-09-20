<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCamerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cameras', function (Blueprint $table) {
            $table->increments('id'); // camera_id

            $table->integer('user_id');

            $table->string('module_id')->unique();    // iemi
            $table->string('iccid')->default('');
            $table->string('model_id')->default('');

            /* infomation */
            $table->string('description')->default('New Camera');
            $table->string('location')->default('');

            $table->integer('points')->default(0);
            $table->integer('points_used')->default(0);

            /* status */
            $table->string('battery')->default('');
            $table->integer('signal_value')->default(0);
            $table->string('card_space')->default('');
            $table->string('card_size')->default('');
            $table->string('temperature')->default('');
            $table->string('dsp_version')->default('');
            $table->string('mcu_version')->default('');
            $table->string('cellular')->default('');

            /* settings */
            $table->string('camera_mode')->default('p');        // p, v
            $table->integer('photo_resolution')->default(0);    // 2, 4, 6, 8, 12
            $table->integer('photo_burst')->default(1);         // 1, 2, 3
            $table->integer('burst_delay')->default(250);       // 250, 500, 1000, 3000ms

            $table->integer('video_resolution')->default(7);    // 7, 8, 9, 10 (11, 12)
            $table->integer('video_fps')->default(4);           // 4, 6, 8, 10, 12, 15, 30 (video_rate)
            $table->integer('video_bitrate')->default(500);     // quality level (1-13)
            $table->integer('video_bitrate7')->default(500);
            $table->integer('video_bitrate8')->default(500);
            $table->integer('video_bitrate9')->default(500);
            $table->integer('video_bitrate10')->default(500);
            $table->integer('video_bitrate11')->default(500);
            $table->integer('video_length')->default(5);        // 2-10s
            $table->string('video_sound')->default('on');       // off, on

            $table->integer('upload_resolution')->default(1);
            $table->integer('photo_quality')->default(0);
            $table->integer('photo_compression')->default(20);

            $table->string('timestamp')->default('on');         // off, on
            $table->string('date_format')->default('Ymd');      // Ymd, mdY, dmY
            $table->string('time_format')->default('24');       // 12, 24
            $table->string('temp_unit')->default('c');          // c, f

            $table->string('quiettime')->default('5s');         // 0s

            $table->string('timelapse')->default('off');        // off, on
            $table->time('tls_start')->default('00:00');        // 00:00
            $table->time('tls_stop')->default('23:59');         // 23:59
            $table->string('tls_interval')->default('5m');      // 10h

            $table->string('wireless_mode')->default('instant');// instant, schedule
            $table->string('wm_schedule')->default('1h');       // 1h
            $table->integer('wm_sclimit')->default(20);         // 20

            $table->string('hb_interval')->default('1h');       // 1h

            $table->integer('online_max_time')->default(2);     // 2
            $table->string('cellularpw')->default('');          //
            $table->string('remotecontrol')->default('off');    // off, 24h

            $table->string('dutytime')->default('off');         // off, on
            $table->string('dt_sun')->default('ffffff');        // ffffff
            $table->string('dt_mon')->default('ffffff');        // ffffff
            $table->string('dt_tue')->default('ffffff');        // ffffff
            $table->string('dt_wed')->default('ffffff');        // ffffff
            $table->string('dt_thu')->default('ffffff');        // ffffff
            $table->string('dt_fri')->default('ffffff');        // ffffff
            $table->string('dt_sat')->default('ffffff');        // ffffff

            $table->string('use_crc32')->default('n');          // n, y

            $table->string('blockmode1')->default('off');       // off, on
            $table->string('blockmode2')->default('off');       // off, on
            $table->string('blockmode3')->default('off');       // off, on
            $table->string('blockmode4')->default('off');       // off, on
            $table->string('blockmode5')->default('off');       // off, on
            $table->string('blockmode7')->default('off');       // off, on
            $table->string('blockmode8')->default('off');       // off, on
            $table->string('blockmode9')->default('off');       // off, on
            $table->string('blockmode10')->default('off');      // off, on
            $table->string('blockmode11')->default('off');      // off, on

            /* event data*/
            $table->dateTime('last_contact')->nullable();       // 1000-01-01 00:00:00 ~ 9999-12-31 23:59:59
            $table->dateTime('last_armed')->nullable();
            $table->integer('arm_photos')->default(0);          // Photos since armed
            $table->integer('arm_points')->default(0);          // Points since armed
            $table->string('last_filename')->nullable();

            $table->dateTime('last_hb')->nullable();
            $table->dateTime('last_photo')->nullable();
            $table->dateTime('last_schedule')->nullable();
            $table->dateTime('last_settings')->nullable();      // Last Downloaded


            $table->dateTime('expected_contact')->nullable();   // Expected Contact

            /* Activity Suppression */
            // Quiet Time Override              INACTIVE
            // Motions Last 15 Mins             0
            // Motions Last Hour                0
            // Motions 5 Min Average            0.00 (Target = 0.00)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cameras');
    }
}
