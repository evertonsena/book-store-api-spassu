<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *     schema="Autor",
 *     type="object",
 *     title="Autor",
 *     @OA\Property(property="codau", type="integer", example="1"),
 *     @OA\Property(property="nome", type="string", example="João Gonçalves"),
 * )
 */
class Author extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'autor';
    protected $primaryKey = 'codau';

    protected $fillable = [
        'nome',
    ];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'livro_autor', 'autor_codau', 'livro_codl');
    }
}
