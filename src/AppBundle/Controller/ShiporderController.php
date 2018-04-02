<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Shiporder;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ShiporderController extends FOSRestController
{
    /**
     * Retorna as encomendas cadastradas na base de dados
     *
     * @ApiDoc(
     *  resource=true
     * )
     * 
     * @Route("/api/shiporder")
     * @Method({"GET"})
    */
    public function getAll()
    {
        $data = $this->getDoctrine()
            ->getRepository(Shiporder::class)
            ->findAll();

        $view = View::create();
        $view->setData($data)->setStatusCode(200);

        return $view;
    }

    /**
     * Retorna as encomendas cadastradas na base de dados (pelo ID)
     *
     * @ApiDoc(
     *  resource=true,
     *  filters={
     *      {"name"="id", "dataType"="integer"}
     *  }
     * )
     * 
     * @Route("/api/shiporder/{id}")
     * @Method({"GET"})
    */
    public function getById($id)
    {
        $data = $this->getDoctrine()
            ->getRepository(Shiporder::class)
            ->find($id);

        $view = View::create();
        $view->setData($data)->setStatusCode(200);

        return $view;
    }
}
