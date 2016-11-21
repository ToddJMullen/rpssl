<?php

namespace RpsslBundle\Controller;

use RpsslBundle\Entity\Round;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Round controller.
 *
 * @Route("round")
 */
class RoundController extends Controller
{
    /**
     * Lists all round entities.
     *
     * @Route("/", name="round_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rounds = $em->getRepository('RpsslBundle:Round')->findAll();

        return $this->render('round/index.html.twig', array(
            'rounds' => $rounds,
        ));
    }

    /**
     * Creates a new round entity.
     *
     * @Route("/new", name="round_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $round = new Round();
        $form = $this->createForm('RpsslBundle\Form\RoundType', $round);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($round);
            $em->flush($round);

            return $this->redirectToRoute('round_show', array('id' => $round->getId()));
        }

        return $this->render('round/new.html.twig', array(
            'round' => $round,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a round entity.
     *
     * @Route("/{id}", name="round_show")
     * @Method("GET")
     */
    public function showAction(Round $round)
    {
        $deleteForm = $this->createDeleteForm($round);

        return $this->render('round/show.html.twig', array(
            'round' => $round,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing round entity.
     *
     * @Route("/{id}/edit", name="round_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Round $round)
    {
        $deleteForm = $this->createDeleteForm($round);
        $editForm = $this->createForm('RpsslBundle\Form\RoundType', $round);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('round_edit', array('id' => $round->getId()));
        }

        return $this->render('round/edit.html.twig', array(
            'round' => $round,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a round entity.
     *
     * @Route("/{id}", name="round_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Round $round)
    {
        $form = $this->createDeleteForm($round);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($round);
            $em->flush($round);
        }

        return $this->redirectToRoute('round_index');
    }

    /**
     * Creates a form to delete a round entity.
     *
     * @param Round $round The round entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Round $round)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('round_delete', array('id' => $round->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
