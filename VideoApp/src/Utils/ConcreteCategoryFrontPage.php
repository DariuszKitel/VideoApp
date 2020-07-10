<?php

namespace App\Utils;

use App\Utils\AbstractClasses\CategoryAbstract;
use function Symfony\Component\VarDumper\Dumper\esc;

class ConcreteCategoryFrontPage extends CategoryAbstract
{
    public $html_1 = '<ul>';
    public $html_2 = '<li>';
    public $html_3 = '<a href="';
    public $html_4 = '">';
    public $html_5 = '</a>';
    public $html_6 = '</li>';
    public $html_7 = '</ul>';

    public function getCategoryListAndParent(int $id) :string
    {
        $parentData = $this->getMainParent($id);
        $this->mainParentName = $parentData['name'];
        $this->mainParentId = $parentData['id'];
        $key = array_search($id, array_column($this->categoriesArrayFromDatabase, 'id'));
        $this->currentCategoryName = $this->categoriesArrayFromDatabase[$key]['name'];
        $categories_array = $this->buildTree($parentData['id']);
        return $this->getCategoryList($categories_array);
    }

    public function getCategoryList(array $categories_array)
    {

        $this->categorylist .= $this->html_1;
        foreach ($categories_array as $value) {

            $catName = $value['name'];

            $url = $this->generator->generate('video_list', ['categoryname' => $catName, 'id' => $value['id']]);

            $this->categorylist .= $this->html_2 . $this->html_3 . $url . $this->html_4 . $catName . $this->html_5;

            if (!empty($value['children'])) {
                $this->getCategoryList($value['children']);
            }
            $this->categorylist .= $this->html_6;
        }
        $this->categorylist .= $this->html_7;
        return $this->categorylist;
    }

    public function getMainParent(int $id) :array
    {
        $key = array_search($id, array_column($this->categoriesArrayFromDatabase, 'id'));

        if ($this->categoriesArrayFromDatabase[$key]['parent_id'] != null) {
            return $this->getMainParent($this->categoriesArrayFromDatabase[$key]['parent_id']);
        }else {
            return [
                'id' => $this->categoriesArrayFromDatabase[$key]['id'],
                'name' => $this->categoriesArrayFromDatabase[$key]['name']
            ];
        }
    }
}