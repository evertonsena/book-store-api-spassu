<?php

namespace App\Repositories\Traits;

use Illuminate\Database\Eloquent\Model;

trait Find
{

    /**
     * get data from model by id
     *
     * @param int $id
     * @return Model
     */
    public function find(int $id): ?Model
    {
        return $this->entity->findOrFail($id);
    }
}
