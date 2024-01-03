<?php
$entity = 'Livro';
return [
    'entity'    => [
        'name' => $entity,
        'fields' => [
            'titulo' => 'Título',
            'editora' => 'Editora',
            'edicao' => 'Edição',
            'anopublicacao' => 'Ano de Publicação',
            'valor' => 'Valor',
        ],
    ],
    'create'    => $entity . ' criado com sucesso.',
    'update'    => $entity . ' alterado com sucesso.',
    'delete'    => $entity . ' excluído com sucesso.',
    'notfound'  => $entity . ' não encontrado.',
];
