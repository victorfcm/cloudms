<?php

namespace CMS\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction()
    {
        return array('links' => array(
            'Admin' => $this->generateUrl('post_cindex'),
            'Master' => $this->generateUrl('post')
            ));
    }
}
