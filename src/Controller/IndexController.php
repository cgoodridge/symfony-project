<?php

namespace App\Controller;

use App\Service\DateService;
use App\Entity\Hotel;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    private const HOTEL_OPENED = 1969;

    /**
     * @Route("/")
     */
    public function home(LoggerInterface $logger, DateService $dateService, ManagerRegistry $doctrine)
    {

        $logger->info('Homepage loaded.');

        $year = $dateService->calculateDate(self::HOTEL_OPENED);

        $hotels = $doctrine->getRepository(Hotel::class)->findAllBelowPrice(750);

        $images = [
            ['url' => 'images/hotel/intro_room.jpg', 'class' => ''],
            ['url' => 'images/hotel/intro_pool.jpg', 'class' => ''],
            ['url' => 'images/hotel/intro_dining.jpg', 'class' => ''],
            ['url' => 'images/hotel/intro_attractions.jpg', 'class' => ''],
            ['url' => 'images/hotel/intro_wedding.jpg', 'class' => 'hidesm'],
        ];

        return $this->render(
            'index.html.twig',
            ['year' => $year, 'images' => $images, 'hotels' => $hotels]
        );
    }
}
