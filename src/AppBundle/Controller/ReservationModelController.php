<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ReservationModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Reservationmodel controller.
 *
 * @Route("reservationmodel")
 */
class ReservationModelController extends Controller
{
    /**
     * Lists all reservationModel entities.
     *
     * @Route("/", name="reservationmodel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservationModels = $em->getRepository('AppBundle:ReservationModel')->findAll();

        return $this->render('reservationmodel/index.html.twig', array(
            'reservationModels' => $reservationModels,
        ));
    }

    /**
     * Creates a new reservationModel entity.
     *
     * @Route("/new", name="reservationmodel_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $reservationModel = new Reservationmodel();
        $form = $this->createForm('AppBundle\Form\ReservationModelType', $reservationModel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservationModel);
            $em->flush();

            return $this->redirectToRoute('reservationmodel_show', array('id' => $reservationModel->getId()));
        }

        return $this->render('reservationmodel/new.html.twig', array(
            'reservationModel' => $reservationModel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reservationModel entity.
     *
     * @Route("/{id}", name="reservationmodel_show")
     * @Method("GET")
     */
    public function showAction(ReservationModel $reservationModel)
    {
        $deleteForm = $this->createDeleteForm($reservationModel);

        return $this->render('reservationmodel/show.html.twig', array(
            'reservationModel' => $reservationModel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reservationModel entity.
     *
     * @Route("/{id}/edit", name="reservationmodel_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ReservationModel $reservationModel)
    {
        $deleteForm = $this->createDeleteForm($reservationModel);
        $editForm = $this->createForm('AppBundle\Form\ReservationModelType', $reservationModel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservationmodel_edit', array('id' => $reservationModel->getId()));
        }

        return $this->render('reservationmodel/edit.html.twig', array(
            'reservationModel' => $reservationModel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reservationModel entity.
     *
     * @Route("/{id}", name="reservationmodel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ReservationModel $reservationModel)
    {
        $form = $this->createDeleteForm($reservationModel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservationModel);
            $em->flush();
        }

        return $this->redirectToRoute('reservationmodel_index');
    }

    /**
     * Creates a form to delete a reservationModel entity.
     *
     * @param ReservationModel $reservationModel The reservationModel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ReservationModel $reservationModel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservationmodel_delete', array('id' => $reservationModel->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
