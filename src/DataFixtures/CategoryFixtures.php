<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category = new Category();
        $category->setName('Grabs');
        $manager->persist($category);

        $category = new Category();
        $category->setName('Butters');
        $manager->persist($category);

        $category = new Category();
        $category->setName('Flips');
        $manager->persist($category);

        $category = new Category();
        $category->setName('Spins');
        $manager->persist($category);

        $manager->flush();
    }
}
