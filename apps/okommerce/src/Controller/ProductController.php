<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="action")
     */
    public function index(EntityManagerInterface $em, NormalizerInterface $normalizerInterface): Response
    {
        $repo = $em->getRepository(Product::class);
        $products = $repo->findBy([]);
        return new JsonResponse(
            $normalizerInterface->normalize(["products" => $products])
        );
    }
}
