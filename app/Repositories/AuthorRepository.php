<?php

namespace App\Repositories;

use App\Models\Author;

final class AuthorRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Author());
    }
}
