<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\Contracts\UserRepoInterface;


class UserLoggedOut
{
    protected $userRepo;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserRepoInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        // dd($event->user->id);
        $this->userRepo->putUserOfline($event->user->id);
    }
}
