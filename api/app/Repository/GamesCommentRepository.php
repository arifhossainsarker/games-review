<?php

namespace App\Repository;

use App\Models\GamesReview;
use App\Interfaces\CommentViewInterface;
use Illuminate\Contracts\Pagination\Paginator;

class GamesCommentRepository implements CommentViewInterface
{
    public function getAll(?int $per_page = 10): Paginator
    {
        return GamesReview::paginate($per_page);
    }

    public function create(array $data): ?GamesReview
    {
        return GamesReview::create($data);
    }
}
