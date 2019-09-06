<?php

namespace App\Listeners;

use App\Models\AccessLog;
use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class LogSuccessfulLogout
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
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        AccessLog::create([
            'ip_address' => $this->request->ip(),
            'user_id' => $event->user->id,
            'event' => 'Cerrar sesión'
        ]);
    }
}
