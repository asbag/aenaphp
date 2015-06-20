<?php

namespace Aena\Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Aena\Bundle\Entity\Aeropuerto;
use Aena\Bundle\Form\AeropuertoType;

/**
 * Aeropuerto controller.
 *
 * @Route("/aeropuerto")
 */
class AeropuertoController extends Controller
{

    /**
     * Lists all Aeropuerto entities.
     *
     * @Route("/", name="aeropuerto")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AenaBundle:Aeropuerto')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Aeropuerto entity.
     *
     * @Route("/", name="aeropuerto_create")
     * @Method("POST")
     * @Template("AenaBundle:Aeropuerto:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Aeropuerto();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('aeropuerto_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Aeropuerto entity.
     *
     * @param Aeropuerto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Aeropuerto $entity)
    {
        $form = $this->createForm(new AeropuertoType(), $entity, array(
            'action' => $this->generateUrl('aeropuerto_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Aeropuerto entity.
     *
     * @Route("/new", name="aeropuerto_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Aeropuerto();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Aeropuerto entity.
     *
     * @Route("/{id}", name="aeropuerto_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AenaBundle:Aeropuerto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aeropuerto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Aeropuerto entity.
     *
     * @Route("/{id}/edit", name="aeropuerto_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AenaBundle:Aeropuerto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aeropuerto entity.');
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
    * Creates a form to edit a Aeropuerto entity.
    *
    * @param Aeropuerto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Aeropuerto $entity)
    {
        $form = $this->createForm(new AeropuertoType(), $entity, array(
            'action' => $this->generateUrl('aeropuerto_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Aeropuerto entity.
     *
     * @Route("/{id}", name="aeropuerto_update")
     * @Method("PUT")
     * @Template("AenaBundle:Aeropuerto:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AenaBundle:Aeropuerto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aeropuerto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('aeropuerto_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Aeropuerto entity.
     *
     * @Route("/{id}", name="aeropuerto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AenaBundle:Aeropuerto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Aeropuerto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('aeropuerto'));
    }

    /**
     * Creates a form to delete a Aeropuerto entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('aeropuerto_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
