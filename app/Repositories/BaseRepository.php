<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Traits\Create;
use App\Repositories\Traits\Delete;
use App\Repositories\Traits\Find;
use App\Repositories\Traits\FindAll;
use App\Repositories\Traits\Update;

abstract class BaseRepository
{
    use Create, Update, Delete, Find, FindAll;

    /**
     * entity model
     *
     * @var Model
     */
    protected $entity;

    /**
     * create a isntance of Model for entity
     *
     * @param Model $entity
     */
    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }
}
