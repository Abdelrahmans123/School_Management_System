<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;

class Calendar extends Component
{
    public $events = '';

    public function getevent()
    {
        $events = Event::select('id', 'title', 'start')->get();

        return  json_encode($events);
    }


    public function addEvent($event)
    {

        $eventData = new Event();
        $eventData->title = $event['title'];
        $eventData->start =  $event['start'];;
        $eventData->save();
    }


    public function eventDrop($event, $oldEvent)
    {
        $eventData = Event::find($event['id']);
        $eventData->start = $event['start'];
        $eventData->save();
    }

    public function deleteEvent($id)
    {
        Event::destroy($id);
    }
    public function render()
    {
        $events = Event::select('id', 'title', 'start')->get();

        $this->events = json_encode($events);

        return view('livewire.calendar');
    }
}