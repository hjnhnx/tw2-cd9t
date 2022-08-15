<?php

namespace App\Jobs;

use App\Models\Group;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotificationAcademicProgress implements ShouldQueue
{
    private $id;
    private $academicProgress;
    private $group;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $id, Group $group, array $academicProgress)
    {
        $this->id = $id;
        $this->group = $group;
        $this->academicProgress = $academicProgress;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $parent = User::where('id', $this->id)->firstOrFail();
            $group = Group::where('id', $this->group->id)->with('teacher')->firstOrFail();
            $teacher = $group->teacher;
            Mail::send('mails.tests.index', ['datas' => $this->academicProgress, 'teacher' => $teacher, 'parent' => $parent, 'group' => $group], function ($msg) use ($parent) {
                $msg->to($parent->email, $parent->full_name)->subject('Academic progress report');
                $msg->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
            });
        } catch (\Exception $e) {
            Log::error($e);
        }
    }
}
