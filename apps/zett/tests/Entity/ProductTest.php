<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class ProductTest extends TestCase
{
    public function testUuids()
    {
        $product = new Product();
        $uid = Uuid::v4();

        $product->setUid($uid);

        $this->assertNotNull($product->getUid());
        $this->assertTrue(Uuid::isValid($product->getUid()));
    }
}
