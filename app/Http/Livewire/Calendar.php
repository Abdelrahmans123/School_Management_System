<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class Calendar extends Component
{
	public $events = '';
	public function mount()
	{
		$this->fetchEvents();
	}
	public function fetchEvents()
	{
		$this->events = Event::select('id', 'title', 'start', 'end')->get()->toArray();
	}
	public function getEvent()
	{
		$events = Event::select('id', 'title', 'start')->get();
		return  json_encode($events);
	}


	public function addEvent($event)
	{
		$input['title'] = $event['title'];
		$input['start'] = $event['start'];
		Event::create($input);
	}
	// Delete event
	public function deleteEvent($eventId)
	{
		Event::destroy($eventId);
	}

	public function eventDrop($event, $oldEvent)
	{
		$eventData = Event::find($event['id']);
		$eventData->start = $event['start'];
		$eventData->save();
	}

	public function render()
	{
		$events = Event::select('id', 'title', 'start')->get();
		$this->events = json_encode($events);
		return view('livewire.calendar');
	}
}
