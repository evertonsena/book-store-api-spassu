<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Services\SubjectService;
use Illuminate\Http\Request;

use const App\Traits\RESPONSE_BAD_REQUEST;
use const App\Traits\RESPONSE_CREATED;
use Illuminate\Support\Facades\Log;

class SubjectController extends Controller
{
    private $subjectService;

    public function __construct(SubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    /**
     *  @OA\Get(
     *     tags={"Assuntos"},
     *     path="/subjects",
     *     summary="Listar os assuntos cadastrados",
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Assunto")
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
        return $this->success($this->subjectService->list('descricao'));
    }

    /**
     *  @OA\Get(
     *     tags={"Assuntos"},
     *     path="/subjects/{id}",
     *     summary="Exibe os dados de um assunto",
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
     *          @OA\JsonContent(ref="#/components/schemas/Assunto")
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return $this->success($this->subjectService->get($id));
    }

    /**
     * @OA\Post(
     *     tags={"Assuntos"},
     *     path="/subjects",
     *     summary="Cria um novo assunto",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Assunto")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(ref="#/components/schemas/Assunto")
     *      ),
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            return $this->success($this->subjectService->store($request->all()), __('subject.create'), RESPONSE_CREATED);
        } catch (\Throwable $err) {
            Log::error('Falha ao criar um novo registro', ['message' => $err->getMessage()]);
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
    }

    /**
     * @OA\Put(
     *     tags={"Assuntos"},
     *     path="/subjects/{id}",
     *     summary="Atualiza os dados de um determinado assunto",
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
     *         @OA\JsonContent(ref="#/components/schemas/Assunto")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(ref="#/components/schemas/Assunto")
     *      ),
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            return $this->success($this->subjectService->update($id, $request->all()), __('subject.update'));
        } catch (\Throwable $err) {
            Log::error('Falha ao atualizar um registro', ['message' => $err->getMessage(), 'id' => $id]);
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
    }

    /**
     * @OA\Delete(
     *     tags={"Assuntos"},
     *     path="/subjects/{id}",
     *     summary="Exclui um assunto",
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
            $this->subjectService->delete($id);
            return $this->deleted();
        } catch (\Throwable $err) {
            Log::error('Falha ao deletar registro', ['message' => $err->getMessage(), 'id' => $id]);
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
    }
}
