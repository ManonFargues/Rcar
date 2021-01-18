<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/annonce", name="annonce")
     */
    public function annonce()
    {
        return $this->render('annonce.html.twig', [
            'cars' => $this->getUser()->getCars(),
        ]);
    }
}