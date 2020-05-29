<?php namespace App\Providers\laravel_fullcalendar\src\MaddHatter\LaravelFullcalendar;

interface IdentifiableEvent extends Event
{

    /**
     * Get the event's ID
     *
     * @return int|string|null
     */
    public function getId();

}