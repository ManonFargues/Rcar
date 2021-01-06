<?php


namespace App\Controller;


use App\Entity\Car;
use App\Entity\Keyword;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function index(CarRepository $carRepository, EntityManagerInterface $manager)
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
    public function add(EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(CarType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $path = $this->getParameter('kernel.project_dir') .'/public/images';

            // récupere valeur soumise sous forme d'obj car
            $car = $form->getData();
            // recuperer l'image
            $image = $car->GetImage();
            // recupere le file soumis
            $file = $image->getFile();

            // creer un nom unique
            $name = md5(uniqid()). '.'.$file->guessExtension();
            //deplace le fichier
            $file->move($path, $name);

            //donner le nom a l'image'
            $image->setName($name);

            $manager->persist($car);
            $manager->flush();

            $this->addFlash(
                'notice',
                'La voiture a bien été ajoutée'
            );


            return $this->redirectToRoute('home');
        }

        return $this->render('home/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(Car $car, EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->flush();
            $this->addFlash(
                'notice',
                'Modification prise en compte'
            );

            return $this->redirectToRoute('home');
        }

        return $this->render('home/edit.html.twig', [
            'car' => $car,
            'form' => $form->createView()
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