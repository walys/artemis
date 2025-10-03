<?php

use Illuminate\Support\Str;

/**
 * Remove todos os caracteres que não são dígitos de um CNPJ.
 *
 * @param string $cnpj CNPJ a ser "limpo".
 *
 * @return string CNPJ sem caracteres que não são dígitos.
 */
function removerCaracteresCNPJ($cnpj) {
    // Remove todos os caracteres que não são dígitos
    return preg_replace('/\D/', '', $cnpj);
}

function createSlug($title) {
    return Str::slug($title);
}