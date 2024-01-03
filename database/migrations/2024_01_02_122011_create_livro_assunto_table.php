<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livro_assunto', function (Blueprint $table) {
            $table->foreignId('livro_codl')
                ->constrained('livro', 'codl')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('assunto_codas')
                ->constrained('assunto', 'codas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livro_assunto');
    }
};
