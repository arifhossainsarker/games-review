<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsRequest;
use App\Repository\GamesCommentRepository;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    use ResponseTrait;

    public $gamesCommentRepository;

    public function __construct(GamesCommentRepository $gamesCommentRepository)
    {
        $this->gamesCommentRepository = $gamesCommentRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     *     path="/api/comment",
     *     tags={"User Comment"},
     *     summary="Create comment",
     *     description="Create Comment",
     *     security={{"bearer":{}}},
     *     @OA\RequestBody(
     *         description="Games objects",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *            @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="games_id",
     *                     description="Games Id",
     *                     type="integer",
     *                     example="Games Id"
     *                 ),
     *                 @OA\Property(
     *                     property="r_star",
     *                     description="Games star",
     *                     type="integer",
     *                     example="games-star"
     *                 ),
     *                 @OA\Property(
     *                     property="u_name",
     *                     description="User Name",
     *                     type="string",
     *                     example="Jhon Doe"
     *                 ),
     *                 @OA\Property(
     *                     property="u_email",
     *                     description="User Email",
     *                     type="string",
     *                     example="jhon@gmail.com"
     *                 ),
     *                  @OA\Property(
     *                     property="comment",
     *                     description="Comment",
     *                     type="text",
     *                     example="Write you comment"
     *                 ),
     *                 required={"games_id", "r_star", "u_email"}
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
    public function store(CommentsRequest $request)
    {
        try {
            return $this->SuccessResponse($this->gamesCommentRepository->create($request->all()), 'Comment added successfully.');
        } catch (Exception $e) {
            return $this->ErrorResponse([], $e->getMessage(), $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
