<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @Route("/product", name="product_")
 */
class ProductController extends AbstractController
{

    private EntityManagerInterface $em;
    private NormalizerInterface $normalizer;

    public function __construct(EntityManagerInterface $em, NormalizerInterface $normalizerInterface) {
        $this->em = $em;
        $this->normalizer = $normalizerInterface;
    }

    /**
     * @Route("/", name="list")
     */
    public function index(): Response
    {
        $repo = $this->em->getRepository(Product::class);
        $products = $repo->findBy([]);
        return new JsonResponse(
            $this->normalizer->normalize(["products" => $products])
        );
    }

    /**
     * @Route("/", methods={"POST"}, name="add")
     */
    public function add(Request $req): Response
    {
        $req->getBody
        $em->persist($product);

        return new JsonResponse(
            $this->normalizer([
                "status" => "persisted",
                "product" => $product
            ])
        );
    }
}
