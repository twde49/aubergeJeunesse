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
            "publicHouses"=>$repository->findAll(),
        ]);
    }

    #[Route("/new",name:"app_publichouse_new")]
    public function new(Request $request, EntityManagerInterface $manager): Response{

        $publicHouse = new PublicHouse();
        $publicHouseForm = $this->createForm(PublicHouseType::class,$publicHouse);
        $publicHouseForm->handleRequest($request);
        if ($publicHouseForm->isSubmitted() && $publicHouseForm->isValid()){
            $manager->persist($publicHouse);
            $manager->flush();

            return $this->redirectToRoute("app_public_house");
        }

        return $this->render("public_house/create.html.twig",[
            "publicHouseForm"=>$publicHouseForm->createView()
        ]);
    }
}
