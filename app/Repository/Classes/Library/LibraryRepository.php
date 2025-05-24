<?php

namespace App\Repository\Classes\Library;

use App\Models\Stage;
use App\Models\Library;
use App\Models\Teacher;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Library\LibraryRepositoryInterface;
use App\Traits\AttachFile;

class LibraryRepository implements LibraryRepositoryInterface
{
	use AttachFile;
	public function index()
	{
		// TODO: Implement index() method.
		$books = Library::all();
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		return view('Pages.Library.index', compact('books', 'translations'));
	}
	public function create()
	{
		// TODO: Implement create() method.
		$stages = Stage::all();
		$teachers = Teacher::all();
		$url = URL::to(App::getLocale() . '/getGrade');
		$sectionUrl = URL::to(App::getLocale() . '/getSection');
		return view('Pages.Library.create', compact('stages', 'teachers', 'url', 'sectionUrl'));
	}
	public function store($request)
	{

		// TODO: Implement store() method.
		$file = $request->file('file_name');
		try {
			$validated = $request->validated();
			$this->uploadFile($file, 'Attachments/books');
			$fileName = $file->getClientOriginalName();
			$books = new Library();
			$books->book_name = $request->book_name;
			$books->stage_id = $request->stage_id;
			$books->teacher_id = $request->teacher_id;
			$books->grade_id = $request->grade_id;
			$books->section_id = $request->section_id;
			$books->file_name = $fileName;
			$books->save();
			flash()->addSuccess(trans('message.dataSaved'));
			return redirect()->route('library.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('library.index');
		}
	}
	public function show($id)
	{
		// TODO: Implement show() method.
	}
	public function edit($id)
	{
		// TODO: Implement edit() method.
		$book = Library::findOrFail($id);
		$stages = Stage::all();
		$teachers = Teacher::all();
		$url = URL::to(App::getLocale() . '/getGrade');
		$sectionUrl = URL::to(App::getLocale() . '/getSection');
		return view('Pages.Library.edit', compact('book', 'stages', 'teachers', 'url', 'sectionUrl'));
	}
	public function update($request)
	{
		// TODO: Implement update() method
		try {
			$validated = $request->validated();
			$book = Library::findOrFail($request->id);
			$book->book_name = $request->book_name;
			$book->stage_id = $request->stage_id;
			$book->teacher_id = $request->teacher_id;
			$book->grade_id = $request->grade_id;
			$book->section_id = $request->section_id;
			if ($request->hasFile('file_name')) {
				$this->deleteFile($book->file_name);
				$file = $request->file('file_name');
				$fileName = $file->getClientOriginalName();
				$this->uploadFile($file, 'Attachments/books');
				$book->file_name = $fileName;
			}
			$book->save();
			flash()->addSuccess(trans('message.dataUpdated'));
			return redirect()->route('library.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('library.index');
		}
	}
	public function destroy($request)
	{
		// TODO: Implement destroy() method.
		try {
			$book = Library::findOrFail($request->id);
			$this->deleteFile('Attachments/books/' . $book->file_name);
			$book->delete();
			flash()->addSuccess(trans('message.dataDeleted'));
			return redirect()->route('library.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('library.index');
		}
	}
	public function download($fileName)
	{
		// TODO: Implement download() method.
		$file = public_path('Attachments/books/' . $fileName);
		return response()->download($file);
	}
}
