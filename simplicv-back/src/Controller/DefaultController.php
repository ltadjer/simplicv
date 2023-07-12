<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route("/{vueRouting}", name: "vue_routing", requirements: ["vueRouting" => ".+"], methods: ["GET"])]
    public function index(): Response
    {
        $html = file_get_contents('../public/build/index.html');
        return new Response($html, 200, ['Content-Type' => 'text/html']);
    }

    
}






