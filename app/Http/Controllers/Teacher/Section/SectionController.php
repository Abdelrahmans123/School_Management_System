<?php

namespace App\Http\Controllers\Teacher\Section;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\Teacher\Section\SectionRepositoryInterface;
use Illuminate\Http\Request;

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
}
