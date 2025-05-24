<?php

namespace App\Http\Controllers\Session;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\StoreSessionRequest;
use App\Repository\Interfaces\Session\SessionRepositoryInterface;

class SessionController extends Controller
{
	protected $session;
	public function __construct(SessionRepositoryInterface $sessionRepositoryInterface)
	{
		$this->session = $sessionRepositoryInterface;
	}
	public function index()
	{
		return $this->session->index();
	}


	public function create()
	{
		return $this->session->create();
	}

	public function store(StoreSessionRequest $request)
	{
		return $this->session->store($request);
	}

	public function indirectSessionStore(Request $request)
	{
		return $this->session->indirectSessionStore($request);
	}

	public function indirectSession()
	{
		return $this->session->indirectSession();
	}

	public function update(StoreSessionRequest $request)
	{
		return $this->session->update($request);
	}

	public function destroy(Request $request)
	{
		return $this->session->destroy($request);
	}
	// OAuth Redirect
	public function redirectToZoom()
	{
		$clientId = config('services.zoom.client_id');
		$redirectUri = route('zoom.callback');
		$scopes = 'meeting:write user:read:admin';
		$zoomAuthUrl = "https://zoom.us/oauth/authorize?response_type=code&client_id={$clientId}&redirect_uri={$redirectUri}&scope={$scopes}";

		return redirect($zoomAuthUrl);
	}

	// Handle Zoom OAuth Callback
	public function handleZoomCallback(Request $request)
	{
		$authorizationCode = $request->input('code');
		$clientId = env('ZOOM_CLIENT_ID');
		$clientSecret = env('ZOOM_CLIENT_SECRET');
		$redirectUri = route('zoom.callback');

		$response = Http::asForm()->post('https://zoom.us/oauth/token', [
			'grant_type' => 'authorization_code',
			'code' => $authorizationCode,
			'redirect_uri' => $redirectUri,
			'client_id' => $clientId,
			'client_secret' => $clientSecret,
		]);

		if ($response->successful()) {
			$data = $response->json();
			// Save access token and refresh token
			User::findOrFail(auth()->user()->id)([
				'zoom_access_token' => $data['access_token'],
				'zoom_refresh_token' => $data['refresh_token'],
				'zoom_token_expires_in' => now()->addSeconds($data['expires_in']),
			]);

			return redirect()->route('sessions.index')->with('success', 'Zoom OAuth successful!');
		}

		return redirect()->route('sessions.index')->with('error', 'Zoom OAuth failed.');
	}
}
