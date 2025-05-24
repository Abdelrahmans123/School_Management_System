<?php

namespace App\Repository\Classes\Session;

use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Stage;
use App\Models\Session;
use App\Models\User;
use App\Traits\ZoomTrait;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use MacsiDigital\Zoom\Facades\Zoom;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Session\SessionRepositoryInterface;

class SessionRepository implements SessionRepositoryInterface
{
	use ZoomTrait;
	public function index()
	{
		$langFile = 'datatables';
		$translations = Lang::get($langFile);
		$sessions = Session::where('created_by', auth()->user()->email)->get();
		// Get the first created_by email from sessions
		$userEmail = Session::all()->pluck('created_by')->first();
		if(auth()->guard('admin')->check()){
			$user = Admin::where('email', $userEmail)->first();
		}else if(auth()->guard('teacher')->check()){
			$user = Teacher::where('email', $userEmail)->first();
		}
		$userName = $user ? [
			'en' => $user->getTranslation('name', 'en') ?? 'Unknown User',
			'ar' => $user->getTranslation('name', 'ar') ?? 'مستخدم غير معروف'
		] : [
			'en' => 'Unknown User',
			'ar' => 'مستخدم غير معروف'
		];

		return view('Pages.Session.index', compact('sessions', 'translations', 'userName'));
	}
	public function create()
	{
		$stages = Stage::all();
		if(auth()->guard('admin')->check()){
			$url = URL::to(App::getLocale() . '/admin/getGrade');
			$sectionUrl = URL::to(App::getLocale() . '/admin/getSection');
		}elseif(auth()->guard('teacher')->check()){
			$url = URL::to(App::getLocale() . '/teacher/getGrade');
			$sectionUrl = URL::to(App::getLocale() . '/teacher/getSection');
		}

		return view('Pages.Session.create', compact('stages', 'url', 'sectionUrl'));
	}
	public function store($request)
	{
		try {
			// Validate the request
			$validated = $request->validated();

			// Check if access token is expired and refresh if necessary
			$accessToken = $this->checkAndRefreshZoomToken();

			// Create Zoom meeting using the trait method and access token
			$zoomMeeting = $this->createZoomMeeting($request, $accessToken);

			// Save session details in your application's database
			$session = new Session();
			$session->topic = $request->topic;
			$session->is_integrated = true;
			$session->start_at = $request->start_time;
			$session->duration = $request->duration;
			$session->start_url = $zoomMeeting->start_url;  // Zoom's meeting start URL for the host
			$session->join_url = $zoomMeeting->join_url;    // Zoom's meeting join URL for participants
			$session->stage_id = $request->stage_id;
			$session->grade_id = $request->grade_id;
			$session->section_id = $request->section_id;
			$session->created_by = auth()->user()->email;         // Get the authenticated user
			$session->password = $zoomMeeting->password;
			$session->meeting_id = $zoomMeeting->id;        // Store Zoom meeting ID
			$session->save();

			flash()->addSuccess(trans('message.dataSaved'));
			if(auth()->guard('admin')->check()){
				return redirect()->route('sessions.index');
			}
            elseif(auth()->guard('teacher')->check()){
				return redirect()->route('teacher.sessions.index');
			}
 // Flash success message
			return redirect()->route('sessions.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());  // Flash error message
			if(auth()->guard('admin')->check()){
				return redirect()->route('sessions.index');
			}
            elseif(auth()->guard('teacher')->check()){
				return redirect()->route('teacher.sessions.index');
			}
		}
	}
	public function update($request)
	{
		//
	}
	public function destroy($request)
	{
		try {
			$session = Session::findOrFail($request->session_id);
			if ($session->is_integrated == true) {
				$meeting = Zoom::meeting()->find($request->meeting_id);
				$meeting->delete();
			}
			$session->delete();
			flash()->addSuccess(trans('message.dataDeleted'));
			if(auth()->guard('admin')->check()){
				return redirect()->route('sessions.index');
			}
            elseif(auth()->guard('teacher')->check()){
				return redirect()->route('teacher.sessions.index');
			}
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());  // Flash error message
			if(auth()->guard('admin')->check()){
				return redirect()->route('sessions.index');
			}
            elseif(auth()->guard('teacher')->check()){
				return redirect()->route('teacher.sessions.index');
			}
		}
	}
	private function checkAndRefreshZoomToken()
	{
		// Check if the token is expired
		$user = auth()->user();

		if (now()->greaterThan($user->zoom_token_expires_in)) {
			// Token is expired, refresh it
			return $this->refreshZoomToken($user->zoom_refresh_token);
		}

		// Return the current access token
		return $user->zoom_access_token;
	}

	private function refreshZoomToken($refreshToken)
	{
		$clientId = config('services.zoom.client_id');
		$clientSecret = config('services.zoom.client_secret');

		$response = Http::asForm()->post('https://zoom.us/oauth/token', [
			'grant_type' => 'refresh_token',
			'refresh_token' => $refreshToken,
			'client_id' => $clientId,
			'client_secret' => $clientSecret,
		]);

		if ($response->successful()) {
			$data = $response->json();
			// Update access token and refresh token in the database
			User::findOrFail(auth()->user()->id)->update([
				'zoom_access_token' => $data['access_token'],
				'zoom_refresh_token' => $data['refresh_token'],
				'zoom_token_expires_in' => now()->addSeconds($data['expires_in']),
			]);

			return $data['access_token'];
		}

		throw new \Exception('Unable to refresh Zoom token.');
	}
	public function indirectSession()
	{
		$stages = Stage::all();
		if(auth()->guard('admin')->check()){
			$url = URL::to(App::getLocale() . '/admin/getGrade');
			$sectionUrl = URL::to(App::getLocale() . '/admin/getSection');
		}elseif(auth()->guard('teacher')->check()){
			$url = URL::to(App::getLocale() . '/teacher/getGrade');
			$sectionUrl = URL::to(App::getLocale() . '/teacher/getSection');
		}
		return view('Pages.Session.Indirect.create', compact('stages', 'url', 'sectionUrl'));
	}
	public function indirectSessionStore($request)
	{
		try {
			// Save session details in your application's database
			$session = new Session();
			$session->topic = $request->topic;
			$session->is_integrated = true;
			$session->start_at = $request->start_time;
			$session->duration = $request->duration;
			$session->start_url = $request->start_link;  // Zoom's meeting start URL for the host
			$session->join_url = $request->join_link;    // Zoom's meeting join URL for participants
			$session->stage_id = $request->stage_id;
			$session->grade_id = $request->grade_id;
			$session->section_id = $request->section_id;
			$session->created_by = auth()->user()->email;         // Get the authenticated user
			$session->password = $request->meeting_password;
			$session->meeting_id = $request->meeting_number;        // Store Zoom meeting ID
			$session->save();

			flash()->addSuccess(trans('message.dataSaved'));  // Flash success message
			return redirect()->route('sessions.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());  // Flash error message
			return redirect()->route('sessions.index');
		}
	}
}
