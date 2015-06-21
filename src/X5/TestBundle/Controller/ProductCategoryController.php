<?php

namespace X5\TestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use X5\TestBundle\Entity\ProductCategory;
use X5\TestBundle\Form\ProductCategoryType;

/**
 * ProductCategory controller.
 *
 * @Route("/category")
 */
class ProductCategoryController extends Controller
{

    /**
     * Lists all ProductCategory entities.
     *
     * @Route("/", name="category")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('X5TestBundle:ProductCategory')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ProductCategory entity.
     *
     * @Route("/", name="category_create")
     * @Method("POST")
     * @Template("X5TestBundle:ProductCategory:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $date = new \DateTime('now');
        $entity = new ProductCategory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $entity->setIsDelete(0)
               ->setCreatedDate($date);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('category_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a ProductCategory entity.
     *
     * @param ProductCategory $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ProductCategory $entity)
    {
        $form = $this->createForm(new ProductCategoryType(), $entity, array(
            'action' => $this->generateUrl('category_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ProductCategory entity.
     *
     * @Route("/new", name="category_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ProductCategory();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ProductCategory entity.
     *
     * @Route("/{id}", name="category_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('X5TestBundle:ProductCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ProductCategory entity.
     *
     * @Route("/{id}/edit", name="category_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('X5TestBundle:ProductCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductCategory entity.');
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
    * Creates a form to edit a ProductCategory entity.
    *
    * @param ProductCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProductCategory $entity)
    {
        $form = $this->createForm(new ProductCategoryType(), $entity, array(
            'action' => $this->generateUrl('category_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProductCategory entity.
     *
     * @Route("/{id}", name="category_update")
     * @Method("PUT")
     * @Template("X5TestBundle:ProductCategory:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('X5TestBundle:ProductCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('category_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ProductCategory entity.
     *
     * @Route("/{id}", name="category_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('X5TestBundle:ProductCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('category'));
    }

    /**
     * Creates a form to delete a ProductCategory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('category_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
