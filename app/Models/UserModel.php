<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'email',
        'password',
        'student_id',
        'course',
        'year_level',
        'section',
        'phone',
        'address',
        'profile_image'
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    public function updateProfile(int $userId, array $data): bool
    {
        return $this->update($userId, $data);
    }

}