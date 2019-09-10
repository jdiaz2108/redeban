<?php

namespace App\Listeners;

use App\Models\AccessLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class LogSuccessfulLogin
{
    protected $request;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        if (!$event->user->last_logged_at) {
        //  Logic to send welcome email
        }
        AccessLog::create([
            'ip_address' => $this->request->ip(),
            'user_id' => $event->user->id,
            'event' => 'Inicio de sesión'
        ]);
    }
}
