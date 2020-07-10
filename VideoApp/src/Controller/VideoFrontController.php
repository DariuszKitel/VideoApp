<?php

namespace App\Controller;

use App\Entity\Category;
use App\Utils\ConcreteCategoryFrontPage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VideoFrontController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {
        return $this->render('video_front/index.html.twig', [

        ]);
    }

    /**
     * @Route("/video-list/category/{categoryname},{id}", name="video_list")
     */
    public function videoList($id, ConcreteCategoryFrontPage $frontPage)
    {
        $frontPage->getCategoryListAndParent($id);
        dump($frontPage);
        return $this->render('video_front/video_list.html.twig',[
            'subcategories' => $frontPage
        ]);
    }

    /**
     * @Route("/video-details", name="video_details")
     */
    public function videoDetails()
    {
        return $this->render('video_front/video_details.html.twig', [

        ]);
    }

    /**
     * @Route("/search-results", methods={"POST"}, name="search_results")
     */
    public function searchResults()
    {
        return $this->render('video_front/search_results.html.twig', [

        ]);
    }

    /**
     * @Route("/pricing", name="pricing")
     */
    public function pricing()
    {
        return $this->render('video_front/pricing.html.twig', [

        ]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function register()
    {
        return $this->render('video_front/register.html.twig', [

        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login()
    {
        return $this->render('video_front/login.html.twig', [

        ]);
    }

    /**
     * @Route("/payment", name="payment")
     */
    public function payment()
    {
        return $this->render('video_front/payment.html.twig', [

        ]);
    }

    public function mainCategories()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)
            ->findBy(['parent'=>null], ['name'=>'ASC']);

        return $this->render('video_front/_main_categories.html.twig',
            ['categories'=>$categories]);
    }
}
