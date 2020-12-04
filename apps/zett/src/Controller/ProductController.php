<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;
use Nelmio\Alice\FixtureBuilder\DenormalizerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/product", name="product_")
 */
class ProductController extends AbstractController
{

    private EntityManagerInterface $em;
    private Serializer $serializer;

    public function __construct(EntityManagerInterface $em, SerializerInterface $serializerInterface)
    {
        $this->em = $em;
        $this->serializer = $serializerInterface;
    }

    /**
     * @Route(methods={"GET"}, name="list")
     */
    public function index(): Response
    {
        $repo = $this->em->getRepository(Product::class);
        $products = $repo->findBy([]);
        return new JsonResponse(
            $this->serializer->normalize(["products" => $products])
        );
    }

    /**
     * @Route(methods={"POST"}, name="add")
     */
    public function add(Request $req): Response
    {
        $product = $this->serializer->denormalize($req->toArray(), Product::class);

        //$em->persist($product);

        return new JsonResponse(
            $this->serializer->normalize([
                "status" => "persisted",
                "product" => $product
            ])
        );
    }
}
