<?php


namespace App\Faker;


use Faker\Provider\Base;

class CarProvider extends Base
{
    const CARBURANT = [
        'Diesel',
        'Electrique',
        'Essence',
    ];

    const COLOR = [
        'Noir',
        'Rouge',
        'Blanc',
        'Gris',
        'Beige',
        'Bleu',
        'Vert'
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