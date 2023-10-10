<?php

namespace App\Controller;

use App\Entity\Bed;
use App\Entity\Booking;
use App\Entity\Dorm;
use App\Form\BookingType;
use App\Repository\DormRepository;
use DateTime;
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

    #[Route("/book/{id}")]
    public function book(Dorm $dorm, Request $request, EntityManagerInterface $manager):Response{

        $book = new Booking();
        $bookForm = $this->createForm(BookingType::class, $book);
        $bookForm->handleRequest($request);
        if ($bookForm->isSubmitted() && $bookForm->isValid()){

            $book->setDorm($dorm);
            $book->setNumberOfNights($book->getLeavingDate()->getTimestamp()-$book->getArrivedDate()->getTimestamp());
            $book->setOfUser($this->getUser());

            $day1 = $book->getLeavingDate()->format("d");
            $day2 = $book->getArrivedDate()->format("d");
            $month1 = $book->getLeavingDate()->format("m");
            $month2 = $book->getArrivedDate()->format("m");
            $year1 = $book->getLeavingDate()->format("Y");
            $year2 = $book->getArrivedDate()->format("Y");

            $sqlData1=$day1 . "." . $month1 . "." . $year1;
            $sqlData2=$day2 . "." . $month2 . "." . $year2;


            $local1=new DateTime($sqlData1);
            $local2=new DateTime($sqlData2);

            $interval = $local1->diff($local2);

            $book->setNumberOfNights($interval->days);


            $nbr = 0;
            $nbrOfClients = $book->getCustomers();
            $nbrOfBedsFree = $book->getDorm()->getBeds();
            foreach ($nbrOfBedsFree as $bedFree){
                if(!$bedFree->isBooked()){
                    $nbr += 1;
                }
            }
            /**if ($nbr>$nbrOfClients){
                for($i = 0;$i<=$nbrOfClients;$i++){

                }
            }**/

            $manager->persist($book);
            $manager->flush();



            return $this->redirectToRoute("app_publichouse_show",[
                "id"=>$dorm->getPublicHouse()->getId()
            ]);
        }


        return $this->render("dorm/book.html.twig",[
            "bookForm"=>$bookForm->createView()
        ]);
    }




}
