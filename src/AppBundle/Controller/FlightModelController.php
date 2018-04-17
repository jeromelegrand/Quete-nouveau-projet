<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FlightModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Flightmodel controller.
 *
 * @Route("flightmodel")
 */
class FlightModelController extends Controller
{
    /**
     * Lists all flightModel entities.
     *
     * @Route("/", name="flightmodel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $flightModels = $em->getRepository('AppBundle:FlightModel')->findAll();

        return $this->render('flightmodel/index.html.twig', array(
            'flightModels' => $flightModels,
        ));
    }

    /**
     * Creates a new flightModel entity.
     *
     * @Route("/new", name="flightmodel_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $flightModel = new Flightmodel();
        $form = $this->createForm('AppBundle\Form\FlightModelType', $flightModel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($flightModel);
            $em->flush();

            return $this->redirectToRoute('flightmodel_show', array('id' => $flightModel->getId()));
        }

        return $this->render('flightmodel/new.html.twig', array(
            'flightModel' => $flightModel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a flightModel entity.
     *
     * @Route("/{id}", name="flightmodel_show")
     * @Method("GET")
     */
    public function showAction(FlightModel $flightModel)
    {
        $deleteForm = $this->createDeleteForm($flightModel);

        return $this->render('flightmodel/show.html.twig', array(
            'flightModel' => $flightModel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing flightModel entity.
     *
     * @Route("/{id}/edit", name="flightmodel_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FlightModel $flightModel)
    {
        $deleteForm = $this->createDeleteForm($flightModel);
        $editForm = $this->createForm('AppBundle\Form\FlightModelType', $flightModel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('flightmodel_edit', array('id' => $flightModel->getId()));
        }

        return $this->render('flightmodel/edit.html.twig', array(
            'flightModel' => $flightModel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a flightModel entity.
     *
     * @Route("/{id}", name="flightmodel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FlightModel $flightModel)
    {
        $form = $this->createDeleteForm($flightModel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($flightModel);
            $em->flush();
        }

        return $this->redirectToRoute('flightmodel_index');
    }

    /**
     * Creates a form to delete a flightModel entity.
     *
     * @param FlightModel $flightModel The flightModel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FlightModel $flightModel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('flightmodel_delete', array('id' => $flightModel->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
