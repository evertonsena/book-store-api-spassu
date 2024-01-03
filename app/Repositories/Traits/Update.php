<?php

namespace App\Repositories\Traits;

trait Update
{

    /**
     * Update data into DB with a Model
     *
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->entity->findOrFail($id)->update($data);
    }
}
