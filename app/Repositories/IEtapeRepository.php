<?php

namespace App\Repositories;

use App\Models\Etape;

use Illuminate\Support\Collection;

interface IEtapeRepository
{
    public function all(int $voyageId=-1): Collection;

    public function find(int $id): Etape;

    public function create(array $data): Etape;

    public function update(int $id, array $data): Etape;

    public function delete(int $id): void;
}
