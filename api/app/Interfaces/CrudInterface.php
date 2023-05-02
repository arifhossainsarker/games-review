<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\Paginator;

interface CrudInterface
{
    public function getAll(): Paginator;

    public function getByid(int $id): object | NULL;

    public function create(array $data): object|null;

    public function update(int $id, array $data): object|null;

    public function delete(int $id): object|null;
}
