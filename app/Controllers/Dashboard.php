<?php

namespace App\Controllers;

use App\Models\StudentModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $model = new StudentModel();
        $data['totalStudents'] = $model->countAll();
        $data['recentStudents'] = $model->orderBy('id', 'DESC')->findAll(5);
        return view('dashboard/index', $data);
    }
}