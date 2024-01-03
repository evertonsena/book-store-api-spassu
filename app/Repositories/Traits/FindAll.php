<?php

namespace App\Repositories\Traits;

use Illuminate\Database\Eloquent\Collection;

trait FindAll
{

    /**
     * get all data from model
     *
     * @return Collection
     */
    public function findAll(string $orderBy = null): ?Collection
    {
        if ($orderBy) {
            return $this->entity->orderBy($orderBy)->get();
        } else {
            return $this->entity->get();
        }
    }
}
