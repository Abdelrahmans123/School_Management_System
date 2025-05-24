<?php

namespace App\DTO;

class GradeDTO
{
	public string $gradeEn;
	public string $gradeAr;
	public int $stageId;
	public function __construct(string $gradeEn, string $gradeAr, int $stageId)
	{
		$this->gradeEn = $gradeEn;
		$this->gradeAr = $gradeAr;
		$this->stageId = $stageId;
	}
}
