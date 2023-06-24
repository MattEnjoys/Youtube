<?php

namespace App\Controller;

use App\Entity\Video;
use App\Form\VideoType;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

// Préfixer la route de tous les chemins, passant de 'app_video_index' a 'index'
#[Route('/video', name: 'app_video_')]
class VideoController extends AbstractController
{
    // 'app_video_index' devient 'index' grace au préfixage des routes
    #[Route('/', name: 'index', methods: ['GET'])]
    // Pour limiter l'accès aux Admins seulement
    #[isGranted('ROLE_ADMIN')]
    public function index(VideoRepository $videoRepository): Response
    {
        return $this->render('video/index.html.twig', [
            'videos' => $videoRepository->findAll(),
        ]);
    }
    // 'app_video_new' devient 'new' grace au préfixage des routes
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    // Pour limiter l'accès aux Admins seulement
    #[isGranted('ROLE_ADMIN')]
    public function new(Request $request, VideoRepository $videoRepository): Response
    {
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $videoRepository->save($video, true);

            return $this->redirectToRoute('app_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('video/new.html.twig', [
            'video' => $video,
            'form' => $form,
        ]);
    }
    // 'app_video_show' devient 'show' grace au préfixage des routes
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Video $video): Response
    {
        return $this->render('video/show.html.twig', [
            'video' => $video,
        ]);
    }
    // 'app_video_delete' devient 'delete' grace au préfixage des routes
    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    // Pour limiter l'accès aux Admins seulement
    #[isGranted('ROLE_ADMIN')]
    public function delete(Request $request, Video $video, VideoRepository $videoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $video->getId(), $request->request->get('_token'))) {
            $videoRepository->remove($video, true);
        }

        return $this->redirectToRoute('app_video_index', [], Response::HTTP_SEE_OTHER);
    }
}