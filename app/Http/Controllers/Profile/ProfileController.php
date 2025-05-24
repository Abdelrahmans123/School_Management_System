<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\Profile\ProfileRepositoryInterface;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profile;
    public function __construct(ProfileRepositoryInterface $profileRepositoryInterface)
    {
        $this->profile = $profileRepositoryInterface;
    }
    public function index()
    {
        return $this->profile->index();
    }

    public function update(Request $request, string $id)
    {
        return $this->profile->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
