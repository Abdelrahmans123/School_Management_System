<?php

namespace App\Http\Controllers\Section;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionRequest;
use App\Repository\Interfaces\Section\SectionRepositoryInterface;

class SectionController extends Controller
{
	protected $section;
	public function __construct(SectionRepositoryInterface $sectionRepositoryInterface)
	{
		$this->section = $sectionRepositoryInterface;
	}
	public function index()
	{
		return $this->section->index();
	}
	public function store(StoreSectionRequest $request)
	{
		return $this->section->store($request);
	}
	public function getGrade($id)
	{
		return $this->section->getGrade($id);
	}
	public function getSection($id)
	{
		return $this->section->getSection($id);
	}
	public function update(StoreSectionRequest $request)
	{
		return $this->section->update($request);
	}

	public function destroy(Request $request)
	{
		return $this->section->destroy($request);
	}
}
