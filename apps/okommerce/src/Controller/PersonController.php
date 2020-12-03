<?php 

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonController extends AbstractController
{
    #[Route('/', name: 'action')]
    public function index(): Response
    {
        $number = random_int(0, 1000);

        return new JsonResponse([
            "hello" => "world", 
            "random" => $number
        ]);
    }
}