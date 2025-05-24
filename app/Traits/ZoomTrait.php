<?php

namespace App\Traits;

use MacsiDigital\Zoom\Facades\Zoom;

trait ZoomTrait
{
	// Zoom-related methods and properties
	public function createZoomMeeting($request, $accessToken)
	{
		$user = Zoom::user()->find('me', $accessToken);

		$meetingData = [
			'topic' => $request->topic,
			'duration' => $request->duration,
			'password' => $request->password,
			'start_time' => $request->start_time,
			'timezone' => config('zoom.timezone'),
		];

		$meetingSettings = [
			'join_before_host' => false,
			'host_video' => false,
			'participant_video' => false,
			'mute_upon_entry' => true,
			'waiting_room' => true,
			'approval_type' => 2,
			'audio' => 'both',
			'auto_recording' => 'none',
		];

		$meeting = Zoom::meeting()->make($meetingData);
		$meeting->settings()->make($meetingSettings);

		return $user->meetings()->save($meeting);
	}
}
