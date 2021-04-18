<?php


namespace App\Controller;

use App\Services\LocationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LocationController extends AbstractController
{
    /**
     * @Route("/location", name="location")
     */
    public function index(LocationService $locationService)
    {
        return $this->render('location.html.twig', [
            'items' => $locationService->getFullLocation()
        ]);
    }

    /**
     * @Route("/location/add/{id}", name="location_add")
     */
    public function addLocation($id, LocationService $locationService)
    {
        $locationService->add($id);

        return $this->redirectToRoute("location");
    }

    /**
     * @Route ("location/remove/{id}", name="location_remove")
     */
    public function remove($id, LocationService $locationService)
    {
        $locationService->remove($id);

        return $this->redirectToRoute("location");
    }
}