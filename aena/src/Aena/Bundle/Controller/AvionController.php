<?php

namespace Aena\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AvionController extends Controller
{
    /**
     * @Route("/clarinete/{david}")
     * @Template()
     */
    public function indexAction($david)
    {
        return array('name' => $david);
    }

    /**
     * @Route("/clarinete2/{david}")
     * @Template()
     */
    public function pruebaAction($david)
    {
        return array('david' => $david);
    }
}
