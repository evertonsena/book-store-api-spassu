<?php

namespace App\Services;

use App\Models\Book;
use App\Repositories\BookRepository;
use Illuminate\Support\Arr;

class BookService extends BaseService
{
    protected $classValidator = 'App\Validators\BookValidator';
    public function __construct(BookRepository $bookRepository)
    {
        parent::__construct($bookRepository);
    }

    public function store(array $data): Book
    {
        $validate = $this->validate($data);
        $book = parent::store($validate);

        if (Arr::has($validate, 'autores')) {
            $book->authors()->sync($this->prepareDataSync($validate['autores']));
        }
        if (Arr::has($validate, 'assuntos')) {
            $book->subjects()->sync($this->prepareDataSync($validate['assuntos']));
        }

        return $book;
    }

    public function update($id, array $data): Book
    {
        $validate = $this->validate($data);
        $book = parent::update($id, $validate);

        if (Arr::has($validate, 'autores')) {
            $book->authors()->sync($this->prepareDataSync($validate['autores']));
        }

        if (Arr::has($validate, 'assuntos')) {
            $book->subjects()->sync($this->prepareDataSync($validate['assuntos']));
        }

        return $book;
    }

    private function prepareDataSync(array $data): array
    {
        $arrayValues = [];
        foreach($data as $value)
        {
            $arrayValues[] = $value['value'];
        }

        return $arrayValues;
    }
}
