<?php


namespace App\Faker;


use Faker\Provider\Base;

class CarProvider extends Base
{
    const CARBURANT = [
        'electrique',
        'diesel',
        'essence',
    ];

    const COLOR = [
        'noir',
        'rouge',
        'blanc',
        'gris',
        'beige',
        'bleu',
        'vert'
    ];

    public function carCarburant() {
        return self::randomElement(self::CARBURANT);
    }

    public function carColor() {
        return self::randomElement(self::COLOR);
    }

    public function carPrice() {
        return rand(100, 6000);
    }
}