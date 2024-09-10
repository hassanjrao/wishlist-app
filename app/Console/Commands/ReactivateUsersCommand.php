<?php

namespace App\Console\Commands;

use App\Http\Controllers\UserRegisterController;
use App\Models\User;
use App\Notifications\ReactiveUserNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ReactivateUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:reactivate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Reactivating users...');
        // $users = User::where('is_approved', 0)
        // ->whereHas('roles', function ($q) {
        //     $q->where('name', 'user');
        // })
        // ->get();

        // get those users who are not approved and were created on this date (make everyone reactive every anniversary year and send out email to tell them# )

        $users = User::where('is_approved', 0)
            ->whereHas('roles', function ($q) {
                $q->where('name', 'user');
            })
            ->whereDate('created_at', now())
            ->get();

        foreach ($users as $user) {
            $user->is_approved = 1;
            $user->save();

            $user->notify(new ReactiveUserNotification($user));

            Log::info('ReactivateUsersCommand', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);

            $this->info('User reactivated: ' . $user->email);
        }

        $this->info('Users reactivated successfully');
    }
}
