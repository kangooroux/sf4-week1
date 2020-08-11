<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RecordController extends AbstractController
{
    /**
     * @Route("/record", name="record_page")
     */
    public function index()
    {
        return $this->render('record/index.html.twig', [
            'controller_name' => 'RecordController',
        ]);
    }
}
