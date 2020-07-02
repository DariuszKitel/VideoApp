<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadMainCategories($manager);
    }

    private function loadMainCategories($manager)
    {
        foreach ($this->getMainCategoriesData() as $name)
        {
            $cat = new Category();
            $cat->setName($name);
            $manager->persist($cat);
        }

        $manager->flush();
    }

    private function getMainCategoriesData()
    {
        return [
                ['electronics', 1],
                ['Toys', 2],
                ['Books', 3],
                ['Movies', 4]
        ];
    }
}
