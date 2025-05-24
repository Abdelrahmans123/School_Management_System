<?php

namespace App\Repository\Classes\Student;

use App\Models\Image;
use App\Models\Stage;
use App\Models\Gender;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\BloodType;
use App\Models\Nationality;
use App\Traits\AttachFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Student\StudentRepositoryInterface;
use PDO;

class StudentRepository implements StudentRepositoryInterface
{
	use AttachFile;
	public function index()
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$students = Student::all();
		return view('Pages.Student.index', compact('translations', 'students'));
	}
	public function dashboard()
	{
		return view('Pages.Student.Dashboard.dashboard');
	}
	public function create()
	{
		$data['stages'] = Stage::all();
		$data['genders'] = Gender::all();
		$data['parents'] = Guardian::all();
		$data['nationalities'] = Nationality::all();
		$data['bloodTypes'] = BloodType::all();
		$url = URL::to(App::getLocale() . '/admin/getGrade');
		$sectionUrl = URL::to(App::getLocale() . '/admin/getSection');
		return view('Pages.Student.create', compact('data', 'url', 'sectionUrl'));
	}
	public function show($id)
	{
		$student = Student::findOrFail($id);
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		return view('Pages.Student.show', compact('student', 'translations'));
	}
	public function store($request)
	{
		DB::beginTransaction();
		try {
			$validated = $request->validated();
			$student = new Student();
			$translations = ['en' => $request->nameEn, 'ar' => $request->nameAr];
			$student->name = $translations;
			$student->email = $request->email;
			$student->password = Hash::make($request->password);
			$student->birthDate = $request->birthDate;
			$student->academicYear = $request->academicYear;
			$student->gender_id = $request->gendersId;
			$student->nationality_id = $request->nationalityId;
			$student->bloodType_id = $request->bloodTypeId;
			$student->stage_id = $request->stageId;
			$student->grade_id = $request->gradeId;
			$student->section_id = $request->sectionId;
			$student->parent_id = $request->parentId;
			$student->save();

			// Define the directory path for storing images
			$studentDirectoryName = $student->name;
			$directoryPath = 'Attachments/studentAttachments/' . $studentDirectoryName;

			if ($request->hasfile('images')) {
				foreach ($request->file('images') as $key) {
					$name = $key->getClientOriginalName();
					$this->uploadFile($key, $directoryPath);
					$image = new Image();
					$image->url = $name;
					$image->imageable_id = $student->id;
					$image->imageable_type = 'App\Models\Student';
					$image->save();
				}
			}

			DB::commit();
			flash()->addSuccess(trans('message.dataSaved'));
			return redirect()->route('student.index');
		} catch (\Exception $e) {
			// Ensure the directory path is defined and available in the catch block
			if (isset($directoryPath)) {
				$fullDirectoryPath = public_path($directoryPath);
				if (file_exists($fullDirectoryPath)) {
					$files = glob($fullDirectoryPath . '/*');
					foreach ($files as $file) {
						unlink($file);
					}
					rmdir($fullDirectoryPath);
				}
			}
			DB::rollBack();
			flash()->addError($e->getMessage());
			return redirect()->route('student.index');
		}
	}


	public function edit($id)
	{
		$student = Student::findOrFail($id);
		$data['stages'] = Stage::all();
		$data['genders'] = Gender::all();
		$data['parents'] = Guardian::all();
		$data['nationalities'] = Nationality::all();
		$data['bloodTypes'] = BloodType::all();
		$url = URL::to(App::getLocale() . '/getGrade');
		$sectionUrl = URL::to(App::getLocale() . '/getSection');
		return view('Pages.Student.edit', compact('data', 'url', 'sectionUrl', 'student'));
	}

	public function update($request)
	{
		try {
			$validated = $request->validated();
			$student = Student::findOrFail($request->studentId);
			$translations = ['en' => $request->nameEn, 'ar' => $request->nameAr];
			$student->name = $translations;
			$student->email = $request->email;
			$student->password = Hash::make($request->password);
			$student->birthDate = $request->birthDate;
			$student->academicYear = $request->academicYear;
			$student->gender_id = $request->gendersId;
			$student->nationality_id = $request->nationalityId;
			$student->bloodType_id = $request->bloodTypeId;
			$student->stage_id = $request->stageId;
			$student->grade_id = $request->gradeId;
			$student->section_id = $request->sectionId;
			$student->parent_id = $request->parentId;
			$student->save();
			flash()->addSuccess(trans('message.dataUpdated'));
			return redirect()->route('student.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('student.index');
		}
	}
	public function destroy($request)
	{
		$student = Student::findOrFail($request->studentId)->delete();
		flash()->addSuccess(trans('message.dataDeleted'));
		return redirect()->route('student.index');
	}
	public function uploadAttachment($request)
	{
		foreach ($request->file('images') as $image) {
			$name = $image->getClientOriginalName();
			$image->storeAs('Attachments/studentAttachments/' . $request->studentName, $name, 'uploads');
			$image = new Image();
			$image->url = $name;
			$image->imageable_id = $request->studentId;
			$image->imageable_type = 'App\Models\Student';
			$image->save();
		}
		flash()->addSuccess(trans('message.dataSaved'));
		return redirect()->route('student.show', $request->studentId);
	}
	public function downloadAttachment($studentName, $fileName)
	{
		return response()->download(public_path('Attachments/studentAttachments/' . $studentName . '/' . $fileName));
	}
	public function deleteAttachment($request)
	{
		$this->deleteFile('Attachments/studentAttachments/' . $request->studentName . '/' . $request->fileName);
		Image::where('id', $request->id)->delete();
		flash()->addSuccess(trans('message.dataDeleted'));
		return redirect()->route('student.show', $request->studentId);
	}
}
