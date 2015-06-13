<?php

namespace Aena\Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Aena\Bundle\Entity\Pasajero;
use Aena\Bundle\Form\PasajeroType;

/**
 * Pasajero controller.
 *
 * @Route("/pasajero")
 */
class PasajeroController extends Controller
{

    /**
     * Lists all Pasajero entities.
     *
     * @Route("/", name="pasajero")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AenaBundle:Pasajero')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Pasajero entity.
     *
     * @Route("/", name="pasajero_create")
     * @Method("POST")
     * @Template("AenaBundle:Pasajero:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Pasajero();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pasajero_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Pasajero entity.
     *
     * @param Pasajero $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pasajero $entity)
    {
        $form = $this->createForm(new PasajeroType(), $entity, array(
            'action' => $this->generateUrl('pasajero_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Pasajero entity.
     *
     * @Route("/new", name="pasajero_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Pasajero();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Pasajero entity.
     *
     * @Route("/{id}", name="pasajero_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AenaBundle:Pasajero')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pasajero entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Pasajero entity.
     *
     * @Route("/{id}/edit", name="pasajero_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AenaBundle:Pasajero')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pasajero entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Pasajero entity.
    *
    * @param Pasajero $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pasajero $entity)
    {
        $form = $this->createForm(new PasajeroType(), $entity, array(
            'action' => $this->generateUrl('pasajero_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Pasajero entity.
     *
     * @Route("/{id}", name="pasajero_update")
     * @Method("PUT")
     * @Template("AenaBundle:Pasajero:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AenaBundle:Pasajero')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pasajero entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pasajero_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Pasajero entity.
     *
     * @Route("/{id}", name="pasajero_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AenaBundle:Pasajero')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pasajero entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pasajero'));
    }

    /**
     * Creates a form to delete a Pasajero entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pasajero_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
