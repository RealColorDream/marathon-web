<?php

namespace App\Repositories;

use App\Models\Etape;
use App\Repositories\IEtapeRepository;
use Illuminate\Support\Collection;

class EtapeRepository implements IEtapeRepository
{

    public function all(int $voyageId = -1): Collection
    {
        $query = Etape::query();
        if ($voyageId != -1) {
            $query->where('voyage_id', $voyageId);
        }
        return $query->get();
    }

    public function find(int $id): Etape
    {
        return Etape::findOrFail($id);
    }

    public function create(array $data): Etape
    {
        return Etape::create($data);
    }

    public function update(int $id, array $data): Etape
    {
        $etape = Etape::findOrFail($id);
        $etape->update($data);
        return $etape;
    }

    public function delete(int $id): void
    {
        Etape::destroy($id);
    }
}
