<?php

namespace App\Repositories;

use App\Models\Subject;

final class SubjectRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Subject());
    }
}
