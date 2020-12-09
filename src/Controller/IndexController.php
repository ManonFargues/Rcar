<?php


namespace App\Controller;


use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CarRepository $carRepository)
    {
        $cars = $carRepository->findAll();

        return $this->render('home/index.html.twig', [
            'cars' => $cars,
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('home/contact.html.twig');
    }

    /**
     * @Route("/add", name="add")
     */
    public function add(EntityManagerInterface $manager)
    {
        $form = $this->createForm(CarType::class);
        return $this->render('home/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(Car $car, EntityManagerInterface $manager)
    {
        $car->setModel("Ferrari");

        $manager->flush($car);

        return $this->render('home/show.html.twig', [
            'car' => $car,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Car $car, EntityManagerInterface $manager)
    {
        $manager->remove($car);
        $manager->flush();
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/show/{id}", name="show")
     */
    public function show(Car $car)
    {
        return $this->render('home/show.html.twig',[
            'car' => $car
        ]);
    }
}