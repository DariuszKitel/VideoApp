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
        $this->loadElectronics($manager);
        $this->loadComputers($manager);
        $this->loadLaptops($manager);
        $this->loadBooks($manager);
        $this->loadMovies($manager);
        $this->loadRomance($manager);
        //$this->loadSubcategories($manager, 'Electronics', 1);
    }

    private function loadMainCategories($manager)
    {
        foreach ($this->getMainCategoriesData() as [$name])
        {
            $cat = new Category();
            $cat->setName($name);
            $manager->persist($cat);
        }

        $manager->flush();
    }

    private function loadElectronics(ObjectManager $manager)
    {
        $this->loadSubcategories($manager, 'Electronics', 1);
    }

    private function loadComputers(ObjectManager $manager)
    {
        $this->loadSubcategories($manager, 'Computers', 6);
    }

    private function loadLaptops(ObjectManager $manager)
    {
        $this->loadSubcategories($manager, 'Laptops', 8);
    }

    private function loadBooks(ObjectManager $manager)
    {
        $this->loadSubcategories($manager, 'Books', 3);
    }

    private function loadMovies(ObjectManager $manager)
    {
        $this->loadSubcategories($manager, 'Movies', 4);
    }

    private function loadRomance(ObjectManager $manager)
    {
        $this->loadSubcategories($manager, 'Romance', 18);
    }

    private function loadSubcategories(ObjectManager $manager, $category, $parent_id)
    {
        $parent = $manager->getRepository(Category::class)->find($parent_id);

        $methodName = "get{$category}Data";

        foreach ($this->$methodName() as [$name])
        {
            $category = new Category();
            $category->setName($name);
            $category->setParent($parent);
            $manager->persist($category);
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

    private function getElectronicsData()
    {
        return [
            ['Cameras', 5],
            ['Computers', 6],
            ['Cell phones', 7]
        ];
    }

    private function getComputersData()
    {
        return [
            ['Laptop', 8],
            ['Desktops', 9]
        ];
    }

    private function getLaptopsData()
    {
        return [
            ['Apple', 10],
            ['Asus', 11],
            ['Dell', 12],
            ['Lenovo', 13],
            ['HP', 14]
        ];
    }

    private function getBooksData()
    {
        return [
            ['Children\'s Books', 15],
            ['Kindle eBooks', 16]
        ];
    }

    private function getMoviesData()
    {
        return [
            ['Family', 17],
            ['Romance', 18]
        ];
    }

    private function getRomanceData()
    {
        return [
            ['Romantic Comedy', 19],
            ['Romantic Drama', 20]
        ];
    }
}
