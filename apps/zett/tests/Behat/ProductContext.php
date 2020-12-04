<?php

declare(strict_types=1);

namespace App\Tests\Behat;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Doctrine\ORM\EntityManagerInterface;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Uid\Uuid;
use Webmozart\Assert\Assert;

final class ProductContext implements Context
{
    use RefreshDatabaseTrait;

    private KernelInterface $kernel;

    private EntityManagerInterface $em;

    private ProductRepository $ProductRepository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $this->em->getRepository(Product::class);
    }

    /**
     * @When I add a new product titled :title with:
     */
    public function iAddANewProductTitledWith($title, PyStringNode $_props)
    {
        $product = new Product();
        $product->setUid(Uuid::v4()->__toString());
        $product->setTitle($title);

        $props = \parse_ini_string($_props->__toString());

        $product->setDescription($props['description']);
        $product->setSku($props['sku']);

        $this->em->persist($product);
        $this->em->flush();
    }

    /**
     * @Then there is a product with sku :sku
     */
    public function thereIsAProductWithTitle($sku)
    {
        $foundProduct = $this->repo->findOneBy(["sku" => $sku]);
        Assert::same($foundProduct->getSku(), $sku);
    }
}
