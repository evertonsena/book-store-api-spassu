<?php

namespace App\Repositories;

use App\Models\Book;

final class BookRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Book());
    }
}
