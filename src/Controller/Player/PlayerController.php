<?php

namespace App\Controller\Player;

use App\Application\Player\CreatePlayerHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends AbstractController
{

    public function __construct(private CreatePlayerHandler $createPlayerHandler)
    {
    }

    #[Route('/api/players', name: 'api_player_create', methods: ['POST'])]
    public function index(Request $request): JsonResponse
    {
        $playerArray = json_decode($request->getContent(), true);

        try {
            $this->createPlayerHandler->handle(
                [
                    'username' => $playerArray['username'],
                    'email' => $playerArray['email'],
                    'password' => $playerArray['password'],
                    'avatar' => $playerArray['avatar']
                ]
            );
        } catch (\Exception $exception) {
            return new JsonResponse($exception->getMessage());
        }

        return new JsonResponse('User created');
    }
}