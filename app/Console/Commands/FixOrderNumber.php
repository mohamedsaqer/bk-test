<?php

namespace App\Console\Commands;

use App\Mail\FixOrderNumberDone;
use App\Models\Student;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class FixOrderNumber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:order-number';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command to fix order number if it is messed up (for example one user was deleted)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $students = Student::groupBy('id', 'school_id')->orderBy('school_id', 'asc')->get();
        foreach ($students as $key => $value) {
            if (isset($students[$key - 1]) && $students[$key]->school_id === $students[$key - 1]->school_id) {
                $students[$key]->update([
                    'order' => $students[$key - 1]->order + 1,
                ]);
            } else {
                $students[$key]->update([
                    'order' => 1,
                ]);
            }
        }
        Mail::to(User::all())->send(new FixOrderNumberDone());

        return 1;
    }
}
