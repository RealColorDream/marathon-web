<?php

namespace App\Repositories;

use App\Models\Voyage;
use App\Repositories\IVoyageRepository;
use Illuminate\Support\Collection;

class VoyageRepository implements IVoyageRepository
{

    public function all(bool $enLigne = null ,int $userId=-1): Collection
    {
        $query = Voyage::query();
        if ($userId==-1) {
            $query->where('user_id', $userId);
        }
        if ($enLigne!==null) {
            $query->where('en_ligne', $enLigne);
        }
        return $query->get();
    }

    public function find(int $id): Voyage
    {
        return Voyage::findOrFail($id);
    }

    public function create(array $data): Voyage
    {
        return Voyage::create($data);
    }

    public function update(int $id, array $data): Voyage
    {
        $voyage = Voyage::findOrFail($id);
        $voyage->update($data);
        return $voyage;
    }

    public function delete(int $id): void
    {
        Voyage::destroy($id);
    }
}
