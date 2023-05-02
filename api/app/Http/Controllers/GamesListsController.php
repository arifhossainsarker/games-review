<?php

namespace App\Http\Controllers;

use App\Models\GamesList;
use App\Repository\GamesListRepository;
use Exception;
use App\Http\Requests\GamesListCreateRequest;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait as TraitsResponseTrait;
use Symfony\Component\HttpFoundation\JsonResponse;

class GamesListsController extends Controller
{

    use TraitsResponseTrait;

    public $gamesListRepository;

    public function __construct(GamesListRepository $gamesListRepository)
    {
        $this->gamesListRepository = $gamesListRepository;
    }
    /**
     * @OA\Get(
     *     path="/api/games-list",
     *     tags={"Games Lists"},
     *     summary="Get all games for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     @OA\Parameter(
     *         name="perPage",
     *         in="query",
     *         description="Per page count",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             default="10",
     *             type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search by title",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             default="",
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="orderBy",
     *         in="query",
     *         description="Order By column name",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             default="id",
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="order",
     *         in="query",
     *         description="Order ordering - asc or desc",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             default="desc",
     *             type="string",
     *         )
     *     ),
     *     security={{"bearer":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        try {
            return $this->SuccessResponse($this->gamesListRepository->getAll(request()->per_page), 'Data Fetch Successfully');
        } catch (Exception $e) {
            return $this->ErrorResponse([], $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @OA\POST(
     *     path="/api/games-list",
     *     tags={"Games Lists"},
     *     summary="Create Games",
     *     description="Create games",
     *     security={{"bearer":{}}},
     *     @OA\RequestBody(
     *         description="Games objects",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *            @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="title",
     *                     description="Games title",
     *                     type="string",
     *                     example="Games title"
     *                 ),
     *                 @OA\Property(
     *                     property="slug",
     *                     description="Games slug",
     *                     type="string",
     *                     example="games-title"
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     description="games price",
     *                     type="integer",
     *                     example="200"
     *                 ),
     *                 @OA\Property(
     *                     property="image",
     *                     description="games image",
     *                     type="string",
     *                     format="binary"
     *                 ),
     *                  @OA\Property(
     *                     property="description",
     *                     description="Description",
     *                     type="text",
     *                     example="description"
     *                 ),
     *                 required={"title", "price"}
     *             )
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */

    public function store(GamesListCreateRequest $request): JsonResponse
    {
        try {
            return $this->SuccessResponse($this->gamesListRepository->create($request->all()), 'Games created successfully.');
        } catch (Exception $e) {
            return $this->ErrorResponse([], $e->getMessage(), $e->getCode());
        }
    }

    /**
     * @OA\Get(
     *     path="/api/games-list/{id}",
     *     tags={"Games Lists"},
     *     summary="Get games detail",
     *     description="Get games detail",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="games-list id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     security={{"bearer":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     )
     * )
     */
    public function show($id)
    {
        try {
            return $this->SuccessResponse($this->gamesListRepository->getById($id), 'Games fetched successfully.');
        } catch (Exception $e) {
            return $this->ErrorResponse([], $e->getMessage(), $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @OA\POST(
     *     path="/api/games-list/{id}",
     *     tags={"Games Lists"},
     *     summary="Update games",
     *     description="Update games",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="games-list id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="_method",
     *         in="query",
     *         description="request method",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="PUT"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Games objects",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="id",
     *                     description="games-list id",
     *                     type="integer",
     *                     example="games-list id"
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     description="games title",
     *                     type="string",
     *                     example="games title"
     *                 ),
     *                 @OA\Property(
     *                     property="slug",
     *                     description="games slug",
     *                     type="string",
     *                     example="games-title"
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     description="games price",
     *                     type="integer",
     *                     example="200"
     *                 ),
     *                 @OA\Property(
     *                     property="image",
     *                     description="games image",
     *                     type="string",
     *                     format="binary"
     *                 ),
     *                  @OA\Property(
     *                     property="description",
     *                     description="Description",
     *                     type="text",
     *                     example="description"
     *                 ),
     *                 required={"title", "price", "slug"}
     *             )
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            return $this->SuccessResponse($this->gamesListRepository->update($id, $request->all()), 'Games updated successfully.');
        } catch (Exception $e) {
            return $this->ErrorResponse([], $e->getMessage(), $e->getCode());
        }
    }

    /**
     * @OA\DELETE(
     *     path="/api/games-list/{id}",
     *     tags={"Games Lists"},
     *     summary="Delete games",
     *     description="Delete games",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="games id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     security={{"bearer":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="games not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        try {
            return $this->SuccessResponse($this->gamesListRepository->delete($id), 'Games deleted successfully.');
        } catch (Exception $e) {
            return $this->ErrorResponse([], $e->getMessage(), $e->getCode());
        }
    }
}
