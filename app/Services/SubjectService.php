<?php

namespace App\Services;

use App\Models\Subject;
use App\Repositories\SubjectRepository;

class SubjectService extends BaseService
{
    protected $classValidator = 'App\Validators\SubjectValidator';
    public function __construct(SubjectRepository $subjectRepository)
    {
        parent::__construct($subjectRepository);
    }

    public function store(array $data): Subject
    {
        return parent::store($this->validate($data));
    }

    public function update($id, array $data): Subject
    {
        return parent::update($id, $this->validate($data));
    }
}
