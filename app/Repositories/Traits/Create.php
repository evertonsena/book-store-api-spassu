<?php

namespace App\Repositories\Traits;

use Illuminate\Database\Eloquent\Model;

trait Create 
{

    /**
     * Create data into DB with a Model
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): ?Model 
    {
		return $this->entity->create($data);
	}
}
