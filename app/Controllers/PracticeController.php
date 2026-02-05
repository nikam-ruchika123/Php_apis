<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\PracticeModel;


class PracticeController extends ResourceController
{
    protected $modelName = PracticeModel::class;
    protected $format    = 'json';

    // GET /users
    public function index()
    {
        $users = $this->model->findAll();
        return $this->respond([
            'status'  => 200,
            'message' => 'Users fetched successfully',
            'data'    => $users
        ]);
    }

    // GET /users/{id}
    public function show($id = null)
    {
        $user = $this->model->find($id);

        if (!$user) {
            return $this->failNotFound('User not found');
        }

        return $this->respond([
            'status'  => 200,
            'message' => 'User fetched successfully',
            'data'    => $user
        ]);
    }

    // POST /users
    public function create()
    {
        $input = $this->request->getJSON();

        if (!$input || empty($input->name) || empty($input->email)) {
            return $this->failValidationErrors('Name and Email are required');
        }

        $data = [
            'name'  => $input->name,
            'email' => $input->email,
        ];

        if ($this->model->insert($data)) {
            return $this->respondCreated([
                'status'  => 201,
                'message' => 'User created successfully',
                'data'    => $data
            ]);
        }

        return $this->failServerError('Failed to insert user');
    }

    // PUT or POST /users/{id} — this handles both automatically
    public function update($id = null)
{
    $user = $this->model->find($id);
    if (!$user) {
        return $this->failNotFound('User not found');
    }

    $input = $this->request->getJSON();
    if (!$input || empty($input->name) || empty($input->email)) {
        return $this->failValidationErrors('Name and Email are required');
    }

    $data = [
        'name'  => $input->name,
        'email' => $input->email,
    ];

    if ($this->model->update($id, $data)) {
        return $this->respond([
            'status'  => 200,
            'message' => 'User updated successfully',
            'data'    => $data
        ]);
    }

    return $this->failServerError('Failed to update user');
}

    // DELETE /users/{id}
    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('User not found');
        }

        if ($this->model->delete($id)) {
            return $this->respondDeleted([
                'status'  => 200,
                'message' => 'User deleted successfully'
            ]);
        }

        return $this->failServerError('Failed to delete user');
    }
}
