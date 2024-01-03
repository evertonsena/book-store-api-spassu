<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCreateRequest;
use App\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use const App\Traits\RESPONSE_BAD_REQUEST;
use const App\Traits\RESPONSE_CREATED;

class BookController extends Controller
{
    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     *  @OA\Get(
     *     tags={"Livros"},
     *     path="/books",
     *     summary="Listar todos os livros cadastrados",
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Livro")
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
        return $this->success($this->bookService->list('codl'));
    }

    /**
     *  @OA\Get(
     *     tags={"Livros"},
     *     path="/books/{id}",
     *     summary="Exibe os dados de um livro",
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
     *          @OA\JsonContent(ref="#/components/schemas/Livro")
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return $this->success($this->bookService->get($id));
    }

    /**
     * @OA\Post(
     *     tags={"Livros"},
     *     path="/books",
     *     summary="Cria um novo livro",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Livro")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(ref="#/components/schemas/Livro")
     *      ),
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            return $this->success($this->bookService->store($request->all()), __('book.create'), RESPONSE_CREATED);
        } catch (\Throwable $err) {
            Log::error('Falha ao criar um novo registro', ['message' => $err->getMessage()]);
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
    }

    /**
     * @OA\Put(
     *     tags={"Livros"},
     *     path="/books/{id}",
     *     summary="Atualiza um determinado livro",
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
     *         @OA\JsonContent(ref="#/components/schemas/Livro")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(ref="#/components/schemas/Livro")
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
            return $this->success($this->bookService->update($id, $request->all()), __('book.update'));
        } catch (\Throwable $err) {
            Log::error('Falha ao atualizar um registro', ['message' => $err->getMessage(), 'id' => $id]);
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
    }

    /**
     * @OA\Delete(
     *     tags={"Livros"},
     *     path="/books/{id}",
     *     summary="Exclui um determinado livro",
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
            $this->bookService->delete($id);
            return $this->deleted();
        } catch (\Throwable $err) {
            Log::error('Falha ao deletar registro', ['message' => $err->getMessage(), 'id' => $id]);
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
    }
}
