<?php

namespace App\Repositories;

use App\Models\Voyage;
use Illuminate\Support\Collection;

interface IVoyageRepository
{
    public function all(bool $en_ligne=null, int $userId=-1): Collection;

    public function find(int $id): Voyage;

    public function create(array $data): Voyage;

    public function update(int $id, array $data): Voyage;

    public function delete(int $id): void;
}
