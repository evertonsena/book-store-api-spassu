<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class BaseService
{
    protected $repository;

    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delete($id)
    {
        return $this->repository->find($id)->delete();
    }

    public function update($id, array $data): Model
    {
        $record = $this->repository->find($id);
        $record->update($data);
        return $record;
    }

    public function get($id): Model
    {
        return $this->repository->find($id);
    }

    public function list(string $orderBy = null): Collection
    {
        return $this->repository->FindAll($orderBy);
    }

    public function store(array $dados): Model
    {
        return $this->repository->create($dados);
    }

    protected function validate(array $dados)
    {
        $validator = new ($this->classValidator)($dados);
        if (!$validator->validate()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }
        return $validator->validated();
    }
}
