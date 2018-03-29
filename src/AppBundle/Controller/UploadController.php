<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UploadController extends Controller
{
    /**
     * @Route("/upload/files")
     * @Method({"POST"})
    */
    public function upload(Request $request)
    {
        $uploadService = $this->container->get('app.upload_service');
        $treatedItems = $uploadService->upload($_FILES['files']);

        $l = $this->get('logger');

        foreach ($treatedItems as $items)
        {
            foreach ($items as $type => $item)
            {
                $l->info(print_r(['type' => $type, 'item' => $item], true));
            }
        }
    }
}
