<?php

namespace App\Interfaces;

interface Product
{
    public function getCartId(): string;
    public function getCartName(): string;
    public function getCartPrice(): float;
    public function getCartImage(): string;
    public function getCartDetails(): array;
}