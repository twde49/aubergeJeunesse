<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Dorm;
use App\Entity\PublicHouse;
use App\Form\BookingType;
use App\Form\DormType;
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
            "hostel"=>$publicHouse,
            "dorms"=>$publicHouse->getDorms()
        ]);

    }


    #[Route("/remove/{id}",name: "app_publichouse_remove")]
    public function remove(PublicHouse $publicHouse, EntityManagerInterface $manager):Response{

        $manager->remove($publicHouse);
        $manager->flush();

        return $this->redirectToRoute("app_public_house");

    }


    #[Route("/add/{id}")]
    public function addDorm(Request $request,PublicHouse $publicHouse, EntityManagerInterface $manager):Response{

        $dorm = new Dorm();
        $dormForm = $this->createForm(DormType::class,$dorm);
        $dormForm->handleRequest($request);
        if ($dormForm->isSubmitted()&& $dormForm->isValid()){
            $dorm->setPublicHouse($publicHouse);
            $manager->persist($dorm);
            $manager->flush();

            return $this->redirectToRoute("app_publichouse_show",[
                "id"=>$publicHouse->getId()
            ]);
        }

        return $this->render("dorm/create.html.twig",[
            "dormForm"=>$dormForm->createView()
        ]);
    }



}
