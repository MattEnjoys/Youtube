<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// 3 - On renomme la classe DefaultController par HomeController
class HomeController extends AbstractController
{
    // 2 - On change le nom de la route /default par /
    // 3 - On renomme app_default par app_home
    #[Route('/', name: 'app_home')]
    // 4 - Pour récupérer les viséos en findAll, il faut acceder au VideoRepository
    public function index(VideoRepository $repository): Response
    {
        // 1 - On change 'default/index.html.twig' par 'index.html.twig'
        // 1 - On enleve ['controller_name' => 'DefaultController',]);]
        // 3 - On renomme index.html.twig par home.html.twig
        return $this->render('home.html.twig', [
            // 4 - Et je peux aller chercher mes vidéos en faisant 'video'(c'est dans twig) équivaut à $repository->findAll()
            'videos' => $repository->findAll()
        ]);
    }
}
