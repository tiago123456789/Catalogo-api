<?php

namespace App\Exceptions;


class MessageException
{
    const NOT_FOUND = "Registro não encontrado!";
    const CATEGORY_ALREADY_EXIST = "Category already exist!";
    const EXIST_PRICE_ACTIVE_TO_PRODUCT = "Existe um preço ativo para o produto especificado!";
    const PRICE_USING_IN_PRODUCT = "Preço está sendo usado em um produto!";
}