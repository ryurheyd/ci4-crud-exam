<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{

    public function show()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');

        $model = new UserModel();

        $user = $model->where('id', $userId)->first();

        if (!$user) {
            session()->destroy();
            return redirect()->to('/login');
        }

        $data['user'] = $user;

        return view('profile/show', $data);
    }

    public function edit()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');

        $model = new UserModel();

        $data['user'] = $model->where('id', $userId)->first();

        return view('profile/edit', $data);
    }

    public function update()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');

        $model = new UserModel();

        $user = $model->where('id', $userId)->first();

        $rules = [
            'name' => 'required',
            'email' => "required|valid_email|is_unique[users.email,id,$userId]",
            'profile_image' => 'permit_empty|is_image[profile_image]|mime_in[profile_image,image/jpg,image/jpeg,image/png,image/webp]|max_size[profile_image,2048]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $removeImage = $this->request->getPost('remove_image') ?? 0;

        $image = $this->request->getFile('profile_image');

        $fileName = $user['profile_image'];

        if ($removeImage == 1 && !empty($user['profile_image'])) {

            $oldPath = FCPATH . 'uploads/profiles/' . $user['profile_image'];

            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            $fileName = null;
        }

        if ($image && $image->isValid() && !$image->hasMoved()) {

            $ext = strtolower($image->getExtension());

            $allowed = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($ext, $allowed)) {
                return redirect()->back()
                    ->with('error', 'Only JPG, JPEG, PNG, and WEBP images are allowed.');
            }

            if (!empty($user['profile_image'])) {

                $oldPath = FCPATH . 'uploads/profiles/' . $user['profile_image'];

                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $fileName = 'avatar_' . $userId . '_' . time() . '.' . $ext;

            $image->move(FCPATH . 'uploads/profiles/', $fileName);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'student_id' => $this->request->getPost('student_id'),
            'course' => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'section' => $this->request->getPost('section'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'profile_image' => $fileName,
            'updated_at' => date('F d, Y • h:i A')
        ];

        $model->updateProfile($userId, $data);

        session()->set('name', $data['name']);

        return redirect()->to('/profile')
            ->with('success', 'Profile updated successfully');
    }

}