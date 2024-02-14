<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Supplier;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        $supplierTypes = ['hotel', 'pista', 'complemento'];

        for ($i = 1; $i <= 10; $i++) {
            $supplier = new Supplier();
            $supplier->setName('Proveedor ' . $i);
            $supplier->setEmail('proveedor' . $i . '@example.com');
            $supplier->setPhone('123-456-78' . $i);
            $supplier->setSupplierType($supplierTypes[array_rand($supplierTypes)]);
            $supplier->setIsActive((bool) random_int(0, 1));
            $manager->persist($supplier);
        }

        $manager->flush();
    }
}
