<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *     schema="Assunto",
 *     type="object",
 *     title="Assunto",
 *     @OA\Property(property="codas", type="integer", example="1"),
 *     @OA\Property(property="descricao", type="string", example="assunto xxx do autor yyy"),
 * )
 */
class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'assunto';
    protected $primaryKey = 'codas';

    protected $fillable = [
        'descricao',
    ];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'livro_assunto', 'assunto_codas', 'livro_codl');
    }
}
