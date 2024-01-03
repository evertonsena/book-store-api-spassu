<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *     schema="Livro",
 *     type="object",
 *     title="Livro",
 *     @OA\Property(property="codl", type="integer", example="17"),
 *     @OA\Property(property="titulo", type="string", example="Titulo de teste"),
 *     @OA\Property(property="editora", type="string", example="Editora de teste"),
 *     @OA\Property(property="edicao", type="integer", example="2"),
 *     @OA\Property(property="anopublicacao", type="integer", example="2023"),
 *     @OA\Property(property="valor", type="number", example="20.00"),
 *     @OA\Property(
 *          property="autores",
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/Autor")
 *     ),
 *     @OA\Property(
 *          property="assuntos",
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/Assunto")
 *     ),
 * )
 */
class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'livro';
    protected $primaryKey = 'codl';

    protected $fillable = [
        'titulo',
        'editora',
        'edicao',
        'anopublicacao',
        'valor',
    ];

    protected $with = ['authors', 'subjects'];
    protected $appends = ['autores','assuntos','valorFormatado'];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'livro_autor', 'livro_codl', 'autor_codau');
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'livro_assunto', 'livro_codl', 'assunto_codas');
    }

    public function getAutoresAttribute()
    {
        return $this->authors->map(function($item){
            return [
                'value' => $item->codau,
                'label' => $item->nome
            ];
        });
    }

    public function getAssuntosAttribute()
    {
        return $this->subjects->map(function($item){
            return [
                'value' => $item->codas,
                'label' => $item->descricao
            ];
        });
    }

    public function getValorFormatadoAttribute()
    {
        return 'R$ ' . $this->valor;
    }
}
