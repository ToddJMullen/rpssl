<?php

namespace RpsslBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @deprecated since version 0.2
     * Left for future use
     */
    public function indexAction()
    {
        return $this->redirectToRoute("/");
    }
}
