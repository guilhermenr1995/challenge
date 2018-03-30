<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Person;
use AppBundle\Entity\Person_phone;
use AppBundle\Entity\Shiporder;
use AppBundle\Entity\Shiporder_shipto;
use AppBundle\Entity\Shiporder_item;

class UploadController extends Controller
{
    /**
     * @Route("/upload/files")
     * @Method({"POST"})
    */
    public function upload(Request $request)
    {   
        $l = $this->get('logger');

        // Ordena os arquivos para people.xml ser lido primeiro
        $aux_files = array();

        for ($i = 0; $i < count($_FILES['files']['name']);  $i++)
        {
            $aux_files[$_FILES['files']['name'][$i]] = [
                'tmp_name' => $_FILES['files']['tmp_name'][$i],
                'type' => $_FILES['files']['type'][$i]
            ];
        }

        ksort($aux_files);
        $arr_files = [];

        foreach ($aux_files as $key => $value) 
        {
            $arr_files['tmp_name'][] = $value['tmp_name'];
            $arr_files['type'][] = $value['type'];
        }

        $uploadService = $this->container->get('app.upload_service');    
        $processedItems = $uploadService->upload($arr_files);
        $people = array();
        $shiporders = array(); 

        foreach ($processedItems as $items)
        {
            foreach ($items as $type => $item)
            {   
                switch ($type) {
                    case 'person':

                        $date = new \DateTime(gmdate('Y-m-d H:i:s'));

                        $person = new Person();
                        $person->setPersonId($item->personid);
                        $person->setPersonName($item->personname);
                        $person->setCreated($date);

                        $personExists = $this->getDoctrine()
                            ->getRepository(Person::class)
                            ->find($item->personid);

                        // Se o registro já existe, o merge não pode sobrescrever o "created"
                        if ($personExists) 
                        {
                            $person->setCreated($personExists->getCreated());
                        }

                        $person->setUpdated($date);
                        $entityManager = $this->getDoctrine()->getManager();
                        $entityManager->merge($person);
                        $entityManager->flush();

                        if (isset($item->phones) && isset($item->phones->phone) && count($item->phones->phone) > 0)
                        {
                            foreach ($item->phones->phone AS $key => $phone)
                            {
                                $phone = (array) $phone;
                                $phone = $phone[0];

                                $person_phone = new Person_phone();
                                $person_phone->setPersonId($person);
                                $person_phone->setPhone($phone);
                                $person_phone->setCreated($date);

                                $phoneExists = $this->getDoctrine()
                                    ->getRepository(Person_phone::class)
                                    ->findOneBy(array('phone' => $phone, 'personid' => $person));

                                $l->info(print_r($phoneExists, TRUE));
                                
                                $person_phone->setUpdated($date);
                                $entityManager = $this->getDoctrine()->getManager();
                                
                                // Se o registro já existe, o merge não pode sobrescrever o "created"
                                if ($phoneExists) 
                                {
                                    $person_phone->setPhoneId($phoneExists->getPhoneId());
                                    $person_phone->setCreated($phoneExists->getCreated());
                                }

                                $entityManager->merge($person_phone);
                                $entityManager->flush();
                            }
                        }

                        break;
                    
                    case 'shiporder':

                        $date = new \DateTime(gmdate('Y-m-d H:i:s'));

                        $shiporder = new Shiporder();
                        $shiporder->setOrderId(intval($item->orderid));
                        $shiporder->setCreated($date);

                        $person = $this->getDoctrine()
                            ->getRepository(Person::class)
                            ->findOneBy(array('personid' => intval($item->orderperson)));

                        $shiporder->setOrderPerson($person);

                        $shiporderExists = $this->getDoctrine()
                            ->getRepository(Shiporder::class)
                            ->findOneBy(array('orderid' => intval($item->orderid), 'orderperson' => $person));

                        // Se o registro já existe, o merge não pode sobrescrever o "created"
                        if ($shiporderExists) 
                        {
                            $shiporder->setShiporderId($shiporderExists->getShiporderId());                            
                            $shiporder->setCreated($shiporderExists->getCreated());
                        }

                        $shiporder->setUpdated($date);
                        $entityManager = $this->getDoctrine()->getManager();
                        $entityManager->merge($shiporder);
                        $entityManager->flush();

                        if (isset($item->shipto))
                        {
                            $shiporder_shipto = new Shiporder_shipto();
                            $shiporder_shipto->setCreated($date);
                            $shiporder_shipto->setShiporderId($shiporder);
                            $shiporder_shipto->setName($item->shipto->name);
                            $shiporder_shipto->setAddress($item->shipto->address);
                            $shiporder_shipto->setCity($item->shipto->city);
                            $shiporder_shipto->setCountry($item->shipto->country);

                            $shiporder_shiptoExists = $this->getDoctrine()
                                ->getRepository(Shiporder_shipto::class)
                                ->findOneBy(array(
                                    'name' => $item->shipto->name, 
                                    'address' => $item->shipto->address, 
                                    'city' => $item->shipto->city, 
                                    'country' => $item->shipto->country
                                ));

                            // Se o registro já existe, o merge não pode sobrescrever o "created"
                            if ($shiporder_shiptoExists) 
                            {
                                $shiporder_shipto->setShiptoId($shiporder_shiptoExists->getShiptoId());                            
                                $shiporder_shipto->setCreated($shiporder_shiptoExists->getCreated());
                            }

                            $shiporder_shipto->setUpdated($date);
                            $entityManager = $this->getDoctrine()->getManager();
                            $entityManager->merge($shiporder_shipto);
                            $entityManager->flush();
                        }

                        if (isset($item->items))
                        {
                            foreach ($item->items as $key => $item)
                            {
                                $shiporder_item = new Shiporder_item();
                                $shiporder_item->setCreated($date);
                                $shiporder_item->setShiporderId($shiporder);
                                $shiporder_item->setTitle($item->item->title);
                                $shiporder_item->setNote($item->item->note);
                                $shiporder_item->setQuantity($item->item->quantity);
                                $shiporder_item->setPrice($item->item->price);

                                $shiporder_itemExists = $this->getDoctrine()
                                    ->getRepository(Shiporder_item::class)
                                    ->findOneBy(array(
                                        'title' => $item->item->title, 
                                        'note' => $item->item->note, 
                                        'quantity' => $item->item->quantity, 
                                        'price' => $item->item->price
                                    ));

                                // Se o registro já existe, o merge não pode sobrescrever o "created"
                                if ($shiporder_itemExists) 
                                {
                                    $shiporder_item->setItemId($shiporder_itemExists->getItemId());                            
                                    $shiporder_item->setCreated($shiporder_itemExists->getCreated());
                                }

                                $shiporder_item->setUpdated($date);
                                $entityManager = $this->getDoctrine()->getManager();
                                $entityManager->merge($shiporder_item);
                                $entityManager->flush();
                            }
                        }

                        break;

                    default:
                        break;
                }
            }
        }

        return $this->render('default/index.html.twig', array(
            'type' => 'success',
            'message' => 'Dados importados com sucesso!'
        ));
    }
}
