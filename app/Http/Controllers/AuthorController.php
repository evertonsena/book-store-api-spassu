<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use Illuminate\Http\Request;

use const App\Traits\RESPONSE_BAD_REQUEST;
use const App\Traits\RESPONSE_CREATED;
use Illuminate\Support\Facades\Log;

class AuthorController extends Controller
{
    private $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     *  @OA\Get(
     *     tags={"Autores"},
     *     path="/authors",
     *     summary="Listar os autores cadastrados",
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Autor")
     *          ),
     *      ),
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success($this->authorService->list('nome'));
    }

    /**
     *  @OA\Get(
     *     tags={"Autores"},
     *     path="/authors/{id}",
     *     summary="Exibe os dados de um autor",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(ref="#/components/schemas/Autor")
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $autor = $this->authorService->get($id);
        return $this->success($autor);
    }

    /**
     * @OA\Post(
     *     tags={"Autores"},
     *     path="/authors",
     *     summary="Criar um novo autor",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Autor")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(ref="#/components/schemas/Autor")
     *      ),
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            return $this->success($this->authorService->store($request->all()), __('author.create'), RESPONSE_CREATED);
        } catch (\Throwable $err) {
            Log::error('Falha ao criar um novo registro', ['message' => $err->getMessage()]);
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
    }

    /**
     * @OA\Put(
     *     tags={"Autores"},
     *     path="/authors/{id}",
     *     summary="Atualizar os dados de um autor",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Autor")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(ref="#/components/schemas/Autor")
     *      ),
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        try {
            return $this->success($this->authorService->update($id, $request->all()), __('author.update'));
        } catch (\Throwable $err) {
            Log::error('Falha ao atualizar um registro', ['message' => $err->getMessage(), 'id' => $id]);
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
    }

    /**
     * @OA\Delete(
     *     tags={"Autores"},
     *     path="/authors/{id}",
     *     summary="Excluir um autor",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->authorService->delete($id);
            return $this->deleted();
        } catch (\Throwable $err) {
            Log::error('Falha ao deletar registro', ['message' => $err->getMessage(), 'id' => $id]);
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
    }
}
