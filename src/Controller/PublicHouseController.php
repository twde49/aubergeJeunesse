<?php

namespace App\Controller;

use App\Entity\PublicHouse;
use App\Form\PublicHouseType;
use App\Repository\PublicHouseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/house")]
class PublicHouseController extends AbstractController
{
    #[Route('/', name: 'app_public_house')]
    public function index(PublicHouseRepository $repository): Response
    {
        return $this->render('public_house/index.html.twig', [
            "hostels"=>$repository->findAll(),
        ]);
    }

    #[Route("/new",name:"app_publichouse_new")]
    public function new(Request $request, EntityManagerInterface $manager): Response{

        $hostel = new PublicHouse();
        $hostelForm = $this->createForm(PublicHouseType::class,$hostel);
        $hostelForm->handleRequest($request);
        if ($hostelForm->isSubmitted() && $hostelForm->isValid()){
            $manager->persist($hostel);
            $manager->flush();

            return $this->redirectToRoute("app_public_house");
        }

        return $this->render("public_house/create.html.twig",[
            "hostelForm"=>$hostelForm->createView()
        ]);
    }

    #[Route("/show/{id}",name:"app_publichouse_show" )]
    public function show(PublicHouse $publicHouse):Response{

        return $this->render("public_house/show.html.twig",[
            "hostel"=>$publicHouse
        ]);

    }


    #[Route("/remove/{id}",name: "app_publichouse_remove")]
    public function remove(PublicHouse $publicHouse, EntityManagerInterface $manager):Response{

        $manager->remove($publicHouse);
        $manager->flush();

        return $this->redirectToRoute("app_public_house");

    }



}
