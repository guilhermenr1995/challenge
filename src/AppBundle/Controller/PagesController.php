<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PagesController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Request $request)
    {
        return $this->render('default/index.html.twig', array(
            'type' => '',
            'message' => ''
        ));
    }
}
