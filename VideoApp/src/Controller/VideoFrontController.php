<?php

namespace App\Controller;

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
     * @Route("/video-list", name="video_list")
     */
    public function videoList()
    {
        return $this->render('video_front/video_list.html.twig', [

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
}
