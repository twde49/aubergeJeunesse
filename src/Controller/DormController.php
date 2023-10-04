<?php

namespace App\Controller;

use App\Entity\Bed;
use App\Entity\Dorm;
use App\Repository\DormRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/dorm")]
class DormController extends AbstractController
{
    #[Route('/', name: 'app_dorm')]
    public function index(DormRepository $repository): Response
    {
        return $this->render('dorm/index.html.twig', [
            'dorms' => $repository->findAll(),
        ]);
    }


    #[Route("/{id}",name: "app_dorm_show")]
    public function show(Dorm $dorm):Response{
        return $this->render("dorm/show.html.twig",[
            "dorm"=>$dorm
        ]);
    }

    #[Route("/addBed/{id}",name: "app_dorm_addbed")]
    public function addBed(Dorm $dorm, Request $request, EntityManagerInterface $manager):Response{

        if ($nbr = $request->get("_nbr")){
            for ($i = 0; $i<= $nbr;$i++){
                $bed = new Bed();
                $bed->setDorm($dorm);
                $manager->persist($bed);
            }
            $manager->flush();

            return $this->redirectToRoute("app_dorm");
        }

        return $this->redirectToRoute("app_dorm");
    }




}
