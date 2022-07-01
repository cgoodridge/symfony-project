<?php


namespace App\Controller;

use App\Entity\Hotel;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ApiController extends AbstractController implements TokenAuthenticatedController
{
    /**
     * @Route("/api/rooms")
     */
    public function home(ManagerRegistry $doctrine)
    {
        $hotels = $doctrine
            ->getRepository(Hotel::class)
            ->findAll();
        return $this->json(['hotels' => $hotels]);
    }
}