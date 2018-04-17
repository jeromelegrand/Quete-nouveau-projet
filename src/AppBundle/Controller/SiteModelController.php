<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SiteModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Sitemodel controller.
 *
 * @Route("sitemodel")
 */
class SiteModelController extends Controller
{
    /**
     * Lists all siteModel entities.
     *
     * @Route("/", name="sitemodel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $siteModels = $em->getRepository('AppBundle:SiteModel')->findAll();

        return $this->render('sitemodel/index.html.twig', array(
            'siteModels' => $siteModels,
        ));
    }

    /**
     * Finds and displays a siteModel entity.
     *
     * @Route("/{id}", name="sitemodel_show")
     * @Method("GET")
     */
    public function showAction(SiteModel $siteModel)
    {

        return $this->render('sitemodel/show.html.twig', array(
            'siteModel' => $siteModel,
        ));
    }
}
