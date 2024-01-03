<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public $connection = 'mysql';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE OR REPLACE VIEW view_book_store AS
            SELECT
                autor.nome
                , livro.titulo, livro.editora, livro.edicao, livro.anopublicacao, livro.valor
                , GROUP_CONCAT(descricao ORDER BY descricao SEPARATOR ', ') assuntos
            FROM autor
            LEFT JOIN livro_autor ON livro_autor.autor_codau = autor.codau
            LEFT JOIN livro ON livro.codl = livro_autor.livro_codl
            LEFT JOIN livro_assunto ON livro_assunto.livro_codl = livro.codl
            LEFT JOIN assunto ON assunto.codas = livro_assunto.assunto_codas
            WHERE assunto.deleted_at IS NULL AND livro.deleted_at IS NULL AND autor.deleted_at IS NULL
            GROUP BY 1,2,3,4,5,6
            ORDER BY autor.nome, livro.titulo
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW bookstore.view_book_store;');
    }
};
