<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\Paginator;

interface CommentViewInterface
{
    public function getAll(): Paginator;

    public function create(array $data): object|null;
}
