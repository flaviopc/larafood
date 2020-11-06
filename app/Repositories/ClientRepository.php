<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ClientRepository implements ClientRepositoryInterface
{

    protected $entity;

    public function __construct(Client $client)
    {
       $this->entity = $client;
    }

    public function getClient(int $id)
    {
        //DB::table($this->table)->select()
    }

    public function createNewClient(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->entity->create($data);
    }
}
