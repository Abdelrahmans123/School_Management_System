<?php

namespace App\Http\Controllers\Stage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStageRequest;
use App\Repository\Interfaces\Stage\StageRepositoryInterface;


class StageController extends Controller
{
	protected $stage;
	public function __construct(StageRepositoryInterface $stageRepositoryInterface)
	{
		$this->stage = $stageRepositoryInterface;
	}

	public function index()
	{
		return $this->stage->index();
	}

	public function store(StoreStageRequest $request)
	{
		return $this->stage->store($request);
	}

	public function update(StoreStageRequest $request)
	{
		return $this->stage->update($request);
	}

	public function destroy(Request $request)
	{
		return $this->stage->destroy($request);
	}
}
