<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //
    ];

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }

    /**
     * Get the directories that should be used to discover events.
     *
     * @return array<int, string>
     */
    public function discoverEventsWithin(): array
    {
        return [
            app_path('Listeners'),
        ];
    }
}
