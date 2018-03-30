<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShiporderController extends Controller
{
    /**
     * @Route("/shiporder")
     */
    public function all(Request $request)
    {
        return $this->render('default/index.html.twig', array(
            'type' => '',
            'message' => ''
        ));
    }

    public function getById($id)
    {
        
    }
}
