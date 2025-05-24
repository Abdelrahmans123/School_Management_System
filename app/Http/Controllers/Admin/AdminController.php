<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\Admin\AdminRepositoryInterface;


class AdminController extends Controller
{
    protected $admin;
    public function __construct(AdminRepositoryInterface $adminRepositoryInterface)
    {
        $this->admin = $adminRepositoryInterface;
    }
    public function index()
    {
        return $this->admin->index();
    }
}
