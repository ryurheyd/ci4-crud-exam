<?php

namespace App\Controllers;

use App\Models\StudentModel;

class Students extends BaseController
{
    public function __construct()
    {
        if (!session()->get('isLoggedIn')) {
            redirect()->to('/login')->send();
            exit;
        }
    }

    public function index()
    {
        $model = new StudentModel();
        $data['students'] = $model->findAll();
        return view('students/index', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'fullname' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'course' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        $model = new StudentModel();
        $model->save([
            'fullname' => $this->request->getPost('fullname'),
            'email' => $this->request->getPost('email'),
            'course' => $this->request->getPost('course'),
        ]);

        return redirect()->back()
            ->with('success', 'Student added successfully');
    }

    public function view($id)
    {
        $model = new StudentModel();
        $data['student'] = $model->find($id);
        return view('students/view', $data);
    }

    public function edit($id)
    {
        $model = new StudentModel();
        $data['student'] = $model->find($id);
        return view('students/edit', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();

        $rules = [
            'fullname' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'course' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        $model = new StudentModel();
        $model->update($id, [
            'fullname' => $this->request->getPost('fullname'),
            'email' => $this->request->getPost('email'),
            'course' => $this->request->getPost('course'),
        ]);

        return redirect()->back()
            ->with('success', 'Student updated successfully');
    }

    public function delete($id)
    {
        $model = new StudentModel();
        $model->delete($id);
        return redirect()->back()
            ->with('success', 'Student deleted successfully');
    }
}