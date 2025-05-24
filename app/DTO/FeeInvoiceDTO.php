<?php

namespace App\DTO;



class FeeInvoiceDTO
{
	public float $amount;
	public ?string $description; // Allow null
	public int $feeType;
	public int $studentId;

	public function __construct(float $amount, ?string $description, int $feeType, int $studentId)
	{
		$this->amount = $amount;
		$this->description = $description ?? null;
		$this->feeType = $feeType;
		$this->studentId = $studentId;
	}
}
