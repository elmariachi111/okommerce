<?php

namespace App\Tests\Integration;

use App\Entity\Product;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Uid\Uuid;

class ProductTest extends KernelTestCase
{
    use RefreshDatabaseTrait;

    /**
     * @var Doctrine\ORM\EntityManagerInterface
     */
    private $em;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->em = $kernel->getContainer()
            ->get('doctrine.orm.entity_manager');
    }

    public function testCreateProduct()
    {
        $product = new Product();
        $product->setUid(Uuid::v4());
        $product->setTitle("Foo Product");
        $product->setDescription("Foo Descr");
        $product->setSku("1234567");

        $this->em->persist($product);
        $this->em->flush();

        $repo = $this->em->getRepository(Product::class);

        $productCount = $repo->findAll();
        $this->assertEquals(1, count($productCount));

        $foundProduct = $repo->findOneBy([]);
        $this->assertSame($foundProduct->getSku(), $product->getSku());
    }

    public function testCreateAnotherProduct()
    {
        $product = new Product();
        $product->setUid(Uuid::v4());
        $product->setTitle("w00t Product");
        $product->setDescription("w00t Descr");
        $product->setSku("7654321");

        $this->em->persist($product);
        $this->em->flush();

        $repo = $this->em->getRepository(Product::class);

        $productCount = $repo->findAll();
        $this->assertEquals(1, count($productCount));

        $foundProduct = $repo->findOneBy([]);
        $this->assertSame($foundProduct->getSku(), $product->getSku());
    }
}
