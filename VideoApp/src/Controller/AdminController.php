<?php

namespace App\Controller;

use App\Entity\Category;
use App\Utils\ConcreteCategoryAdminList;
use App\Utils\ConcreteCategoryAdminOptionList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_main")
     */
    public function index()
    {
        return $this->render('admin/my_profile.html.twig');
    }

    /**
     * @Route("/categories", name="categories")
     */
    public function categories(ConcreteCategoryAdminList $adminList)
    {
        $adminList->getCategoryList($adminList->buildTree());
        return $this->render('admin/categories.html.twig', [
            'categories' => $adminList->categorylist
        ]);
    }

    /**
     * @Route("/edit-category/{id}", name="edit_category")
     */
    public function editCategory(Category $cat)
    {
        return $this->render('admin/edit_category.html.twig', [
            'category' => $cat
        ]);
    }

    /**
     * @Route("/delete-category/{id}", name="delete_category")
     */
    public function deleteCategory(Category $category)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($category);
        $entityManager->flush();
        return $this->redirectToRoute('categories');
    }

    /**
     * @Route("/videos", name="videos")
     */
    public function videos()
    {
        return $this->render('admin/videos.html.twig');
    }

    /**
     * @Route("/uplod-video", name="upload_video")
     */
    public function uploadVideo()
    {
        return $this->render('admin/upload_video.html.twig');
    }

    /**
     * @Route("/users", name="users")
     */
    public function users()
    {
        return $this->render('admin/users.html.twig');
    }

    public function getAllCategories(ConcreteCategoryAdminOptionList $adminOptionList, $editedCategory = null)
    {
        $adminOptionList->getCategoryList($adminOptionList->buildTree());
        return $this->render('admin/all_categories.html.twig', [
            'categories' => $adminOptionList,
            'editedCategory' => $editedCategory
        ]);
    }
}
