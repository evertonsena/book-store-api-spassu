<?php

namespace App\Repositories\Traits;

trait Delete 
{

    /**
     * Delete data into DB with a Model
     *
     * @param array $data
     * @return bool
     */
    public function delete(int $id): bool 
    {
		return $this->entity->destroy($id);
	}
}
