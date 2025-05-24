<?php

namespace App\Traits;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

trait AuthTrait
{

	protected function redirect(Request $request)
	{
		$type = $request->input('type');

		return match ($type) {
			'admin' => redirect()->intended(RouteServiceProvider::ADMIN),
			'teacher' => redirect()->intended(RouteServiceProvider::TEACHER),
			'student' => redirect()->intended(RouteServiceProvider::STUDENT),
			'parent' => redirect()->intended(RouteServiceProvider::PARENT),
			default => redirect()->intended(RouteServiceProvider::HOME),
		};
	}
}
