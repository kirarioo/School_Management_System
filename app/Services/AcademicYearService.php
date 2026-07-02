<?php

namespace App\Services;

use App\Repositories\AcademicYearRepository;

class AcademicYearService
{
    protected $repository;

    public function __construct(AcademicYearRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function create(array $data)
    {
        if (!empty($data['is_active']) && $data['is_active']) {
            \App\Models\AcademicYear::query()->update([
                'is_active' => false,
            ]);
        }

        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        if (!empty($data['is_active']) && $data['is_active']) {
            \App\Models\AcademicYear::query()->update([
                'is_active' => false,
            ]);
        }

        return $this->repository->update($id, $data);

    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }
}