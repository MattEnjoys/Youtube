<?php

namespace App\Controller;

use App\Entity\Playlist;
use App\Entity\User;
use App\Entity\Video;
use App\Form\PlaylistType;
use App\Repository\PlaylistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/playlist')]
#[IsGranted('ROLE_USER')]
class PlaylistController extends AbstractController
{
    // 3 - On injecte cette fonction pour pouvoir la réutiliser dans la page
    public function __construct(private PlaylistRepository $playlistRepository)
    {
    }

    #[Route('/', name: 'app_playlist_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('playlist/index.html.twig', ['playlists' => $this->playlistRepository->findAll()]);
    }

    #[Route('/new', name: 'app_playlist_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        // 1 - On rajoute l'utilisateur courant au seins de la playlist
        /** @var User $user */
        $user = $this->getUser();
        // 1 - On rajoute l'utilisateur courant au seins de la playlist

        $playlist = new Playlist();
        $form = $this->createForm(PlaylistType::class, $playlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // 1 - On rajoute l'utilisateur courant au seins de la playlist
            $playlist->setUser($user);
            $this->playlistRepository->save($playlist, true);

            return $this->redirectToRoute('app_playlist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('playlist/new.html.twig', ['playlist' => $playlist, 'form' => $form]);
    }

    // 2 - Pour associer playlist à video
    #[Route('/{video}/{playlist}', name: 'app_playlist_add_video', methods: ['GET'])]
    // Normalement, on devrais faire ici un Voter, un element de sécurité pour vérifier que la playlist est bien la mienne
    public function addVideo(Video $video, Playlist $playlist): Response
    {
        $playlist->addVideo($video);
        $this->playlistRepository->save($playlist, true);

        return $this->redirectToRoute('app_playlist_index');
    }

    #[Route('/{id}', name: 'app_playlist_delete', methods: ['POST'])]
    public function delete(Request $request, Playlist $playlist, PlaylistRepository $playlistRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $playlist->getId(), $request->request->get('_token'))) {
            $playlistRepository->remove($playlist, true);
        }

        return $this->redirectToRoute('app_playlist_index', [], Response::HTTP_SEE_OTHER);
    }
}