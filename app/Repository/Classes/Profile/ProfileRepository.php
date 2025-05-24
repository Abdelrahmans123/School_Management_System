<?php

namespace App\Repository\Classes\Profile;

use App\Models\Guardian;
use App\Models\Student;
use App\Models\Teacher;
use App\Repository\Interfaces\Profile\ProfileRepositoryInterface;

use Illuminate\Support\Facades\Hash;

class ProfileRepository implements ProfileRepositoryInterface
{
	public function index()
	{
		$user = auth()->user();
		return view('Pages.Profile.index', compact('user'));
	}
	public function update($request)
	{
		try {
			if (auth()->guard('teacher')->check()) {
				if (!empty($request->password)) {
					$teacher = Teacher::find(auth()->user()->id);
					$translation = ['en' => $request->nameEn, 'ar' => $request->nameAr];
					$teacher->name = $translation;
					$teacher->password = Hash::make($request->password);
					$teacher->save();
				} else {
					$teacher = Teacher::find(auth()->user()->id);
					$translation = ['en' => $request->nameEn, 'ar' => $request->nameAr];
					$teacher->name = $translation;
					$teacher->save();
				}
			} else if (auth()->guard('student')->check()) {
				if (!empty($request->password)) {
					$teacher = Student::find(auth()->user()->id);
					$translation = ['en' => $request->nameEn, 'ar' => $request->nameAr];
					$teacher->name = $translation;
					$teacher->password = Hash::make($request->password);
					$teacher->save();
				} else {
					$teacher = Student::find(auth()->user()->id);
					$translation = ['en' => $request->nameEn, 'ar' => $request->nameAr];
					$teacher->name = $translation;
					$teacher->save();
				}
			} else if (auth()->guard('parent')->check()) {
				if (!empty($request->password)) {
					$parent = Guardian::find(auth()->user()->id);
					$fatherNameTranslations = ['en' => $request->fatherNameEn, 'ar' => $request->fatherNameAr];
					$parent->fatherName = $fatherNameTranslations;
					$motherNameTranslations = ['en' => $request->motherNameEn, 'ar' => $request->motherNameAr];
					$parent->motherName = $motherNameTranslations;
					$parent->password = Hash::make($request->password);
					$parent->save();
				} else {
					$parent = Guardian::find(auth()->user()->id);
					$fatherNameTranslations = ['en' => $request->fatherNameEn, 'ar' => $request->fatherNameAr];
					$parent->fatherName = $fatherNameTranslations;
					$motherNameTranslations = ['en' => $request->motherNameEn, 'ar' => $request->motherNameAr];
					$parent->motherName = $motherNameTranslations;
					$parent->save();
				}
			}

			flash()->addSuccess(trans('message.dataSaved'));
			if (auth()->guard('teacher')->check()) {
				return redirect()->route('teacher.profile.index');
			} else if (auth()->guard('student')->check()) {
				return redirect()->route('student.profile.index');
			} else if (auth()->guard('parent')->check()) {
				return redirect()->route('parent.profile.index');
			}
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			if (auth()->guard('teacher')->check()) {
				return redirect()->route('teacher.profile.index');
			} else if (auth()->guard('student')->check()) {
				return redirect()->route('student.profile.index');
			} else if (auth()->guard('parent')->check()) {
				return redirect()->route('parent.profile.index');
			}
		}
	}
}
