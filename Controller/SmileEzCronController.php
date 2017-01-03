<?php

namespace Smile\EzUICronBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Smile\EzUICronBundle\Entity\SmileEzCron;
use Smile\EzUICronBundle\Form\Type\SmileEzCronType;

/**
 * SmileEzCron controller.
 *
 */
class SmileEzCronController extends Controller
{
    /**
     * Displays a form to edit an existing SmileEzCron entity.
     *
     */
    public function editAction($alias)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmileEzUICronBundle:SmileEzCron')->find($alias);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SmileEzCron entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('SmileEzUICronBundle:SmileEzCron:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        ));
    }

    /**
    * Creates a form to edit a SmileEzCron entity.
    *
    * @param SmileEzCron $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SmileEzCron $entity)
    {
        $form = $this->createForm(new SmileEzCronType(), $entity, array(
            'action' => $this->generateUrl('cron_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing SmileEzCron entity.
     *
     */
    public function updateAction(Request $request, $alias)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmileEzUICronBundle:SmileEzCron')->find($alias);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SmileEzCron entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('smileezcron_cron_edit', array('alias' => $alias)));
        }

        return $this->render('SmileEzUICronBundle:SmileEzCron:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        ));
    }
}
