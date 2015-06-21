<?php

namespace X5\TestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Default controller.
 *
 *  
 */
class DefaultController extends Controller
{
	 /** Default hompage
     * @Route("/", name="x5_homepage")
     * @Template("X5TestBundle:Default:hompage.html.twig")
     */
    

    public function hompageAction(Request $request)
    {   
           
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('X5TestBundle:ProductCategory')->findAll();

        return array('entities' => $entities);
    }

    /** Default hompage
     * @Route("/list", name="x5_homepage_list")
     * @Template("X5TestBundle:Default:list.html.twig")
     */
    public function listProductAction(Request $request)
    {   
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $fieldRepo = $em
                ->getRepository('X5TestBundle:Product');
        $entities = $fieldRepo->findBy(array('productCategory' => $id));

        return array('entities' => $entities);
    }

     /**
     * Finds and displays a Product entity.
     *
     * @Route("/list/{id}", name="x5_homepage_show")
     * @Method("GET")
     * @Template("X5TestBundle:Default:show.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('X5TestBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        return array('entity'=> $entity);
    }
}
