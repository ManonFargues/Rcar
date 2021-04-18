<?php

namespace App\Services;

use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LocationService {

    protected $session;
    protected $carRepository;

    public function __construct(SessionInterface $session, CarRepository $carRepository)
    {
        $this->session = $session;
        $this->carRepository = $carRepository;
    }

    public function add(int $id)
    {
        $louer = $this->session->get('louer', []);

        $louer[$id] = 1;

        $this->session->set('louer', $louer);
    }
    public function remove(int $id)
    {
        $louer = $this->session->get('louer', []);

        if(!empty($louer[$id])) {
            unset($louer[$id]);
        }

        $this->session->set('louer', $louer);
    }

    public function getFullLocation(): array
    {
        $louer = $this->session->get('louer', []);

        $louerWithData = [];

        foreach ($louer as $id => $quantity) {
            $louerWithData[] = [
                'car' => $this->carRepository->find($id),
                'quantity' => $quantity
            ];
        }

        return $louerWithData;
    }

}