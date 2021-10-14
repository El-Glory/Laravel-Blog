<?php

namespace App\Console\Commands;

require 'vendor/autoload.php';

use Carbon\Carbon;
use App\Models\User;
use App\Models\Post;
use App\Notifications\PostsOverview;
use Illuminate\Support\Facades\Notification;
use Illuminate\Console\Command;

class NotificationOverview extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:overview';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron job should be run that sends an overview of changes in the last 24 hrs';

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
        $users = User::all();
        $posts = Post::whereDate('created_at', Carbon::today())->get();
        $PostCount = $posts->count();
        foreach ($users as $user) {
            Notification::route('mail', $user->email) //Sending mail to user
                ->notify(new PostsOverview($PostCount)); //With new post                                                                                                                                                        
        }
    }
}
