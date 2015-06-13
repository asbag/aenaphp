<?php

namespace Aena\Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Aena\Bundle\Entity\Billete;
use Aena\Bundle\Form\BilleteType;

/**
 * Billete controller.
 *
 * @Route("/billete")
 */
class BilleteController extends Controller
{

    /**
     * Lists all Billete entities.
     *
     * @Route("/", name="billete")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AenaBundle:Billete')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Billete entity.
     *
     * @Route("/", name="billete_create")
     * @Method("POST")
     * @Template("AenaBundle:Billete:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Billete();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('billete_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Billete entity.
     *
     * @param Billete $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Billete $entity)
    {
        $form = $this->createForm(new BilleteType(), $entity, array(
            'action' => $this->generateUrl('billete_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Billete entity.
     *
     * @Route("/new", name="billete_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Billete();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Billete entity.
     *
     * @Route("/{id}", name="billete_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AenaBundle:Billete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Billete entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Billete entity.
     *
     * @Route("/{id}/edit", name="billete_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AenaBundle:Billete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Billete entity.');
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
    * Creates a form to edit a Billete entity.
    *
    * @param Billete $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Billete $entity)
    {
        $form = $this->createForm(new BilleteType(), $entity, array(
            'action' => $this->generateUrl('billete_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Billete entity.
     *
     * @Route("/{id}", name="billete_update")
     * @Method("PUT")
     * @Template("AenaBundle:Billete:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AenaBundle:Billete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Billete entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('billete_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Billete entity.
     *
     * @Route("/{id}", name="billete_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AenaBundle:Billete')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Billete entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('billete'));
    }

    /**
     * Creates a form to delete a Billete entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('billete_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
