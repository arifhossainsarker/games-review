<?php

namespace App\Repository;

use Exception;
use App\Interfaces\CrudInterface;
use App\Models\GamesList;
use App\Interfaces\DBPreparableInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Pagination\Paginator;

class GamesListRepository implements CrudInterface, DBPreparableInterface
{

    public function getAll(?int $per_page = 10): Paginator
    {
        return GamesList::paginate($per_page);
    }

    public function getById(int $id): GamesList
    {
        $games_list = GamesList::find($id);

        if (empty($games_list)) {
            throw new Exception("Games does not exist.", Response::HTTP_NOT_FOUND);
        }

        return $games_list;
    }

    public function create(array $data): ?GamesList
    {
        $data = $this->prepareForDB($data);

        return GamesList::create($data);
    }

    public function update(int $id, array $data): ?GamesList
    {
        $games_list = $this->getById($id);

        $updated = $games_list->update($this->prepareForDB($data, $games_list));

        if ($updated) {
            $games_list = $this->getById($id);
        }

        return $games_list;
    }

    public function delete(int $id): ?GamesList
    {
        $games_list = $this->getById($id);

        $this->deleteImage($games_list->image_url);

        $deleted = $games_list->delete();

        if (!$deleted) {
            throw new Exception("Games could not be deleted.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $games_list;
    }

    public function prepareForDB(array $data, ?GamesList $games_list = null): array
    {
        if (empty($data['slug'])) {
            $data['slug'] = $this->createUniqueSlug($data['title']);
        }

        if (!empty($data['image'])) {
            if (!is_null($games_list)) {
                $this->deleteImage($games_list->image_url);
            }
            $data['image'] = $this->uploadImage($data['image']);
        }

        $data['user_id'] = Auth::id();

        return $data;
    }

    private function createUniqueSlug(string $title): string
    {
        return Str::slug(substr($title, 0, 80)) . '-' . time();
    }

    private function uploadImage($image): string
    {
        $imageName = time() . '.' . $image->extension();

        $image->storePubliclyAs('public', $imageName);

        return $imageName;
    }

    private function deleteImage(?string $imageUrl): void
    {
        if (!empty($imageUrl)) {
            $imageName = ltrim(strstr($imageUrl, 'storage/'), 'storage/');

            if (!empty($imageName) && Storage::exists('public/' . $imageName)) {
                Storage::delete('public/' . $imageName);
            }
        }
    }
}
