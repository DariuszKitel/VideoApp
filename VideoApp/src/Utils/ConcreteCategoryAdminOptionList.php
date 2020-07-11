<?php

namespace App\Utils;

use App\Utils\AbstractClasses\CategoryAbstract;
use PhpParser\Node\Stmt\Foreach_;

class ConcreteCategoryAdminOptionList extends CategoryAbstract
{

    function getCategoryList(array $categories_array, int $repeat = 0)
    {
        foreach ($categories_array as $value) {

            $this->categorylist[] = ['name' => str_repeat("-", $repeat).$value['name'], 'id' => $value['id']];

            if (!empty($value['children'])) {
                $repeat = $repeat + 2;
                $this->getCategoryList($value['children'], $repeat);
                $repeat = $repeat -2;
            }
        }
    }
}