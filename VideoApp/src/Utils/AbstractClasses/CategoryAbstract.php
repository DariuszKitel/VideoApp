<?php

namespace App\Utils\AbstractClasses;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

abstract class CategoryAbstract
{

    protected static $dbconnection;

    public $categoriesArrayFromDatabase;

    public $categorylist;

    public function __construct(EntityManagerInterface $manager, UrlGeneratorInterface $generator)
    {
        $this->manager = $manager;
        $this->generator = $generator;
        $this->categoriesArrayFromDatabase = $this->getCategories();
    }

    abstract function getCategoryList(array $categories_array);


    public function buildTree(int $paren_id = null) :array
    {
        $subcategory = [];

        foreach ( $this->categoriesArrayFromDatabase as $category) {
            if ($category['parent_id'] == $paren_id) {

                $children = $this->buildTree($category['id']);

                if ($children) {
                    $category['children'] = $children;
                }
                $subcategory[] = $category;
            }
        }
        return $subcategory;
    }

    private function getCategories() : array
    {
        if (self::$dbconnection) {
            return self::$dbconnection;
        } else {
            $con = $this->manager->getConnection();
            $sql = "SELECT * FROM categories";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            return self::$dbconnection = $stmt->fetchAll();
        }
    }

}
