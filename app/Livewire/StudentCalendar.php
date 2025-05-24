<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class StudentCalendar extends Component
{
    public $events = '';

    public function getEvent()
    {
        $events = Event::select('id', 'title', 'start')->get();

        return  json_encode($events);
    }
    public function render()
    {
        $events = Event::select('id', 'title', 'start')->get();
        $this->events = json_encode($events);
        return view('livewire.student-calendar');
    }
}