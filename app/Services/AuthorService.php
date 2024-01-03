<?php

namespace App\Services;

use App\Models\Author;
use App\Repositories\AuthorRepository;

class AuthorService extends BaseService
{
    protected $classValidator = 'App\Validators\AuthorValidator';
    public function __construct(AuthorRepository $authorRepository)
    {
        parent::__construct($authorRepository);
    }

    public function store(array $data): Author
    {
        return parent::store($this->validate($data));
    }

    public function update($id, array $data): Author
    {
        return parent::update($id, $this->validate($data));
    }
}
