<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Person;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

class PersonController extends FOSRestController
{
    /**
     * @Route("/api/person")
     * @Method({"GET"})
    */
    public function getAll()
    {
        $data = $this->getDoctrine()
            ->getRepository(Person::class)
            ->findAll();

        $view = View::create();
        $view->setData($data)->setStatusCode(200);

        return $view;
    }
}
