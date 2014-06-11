<?php

namespace Fd\TablaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrap3View;

use Fd\TablaBundle\Entity\Barrio;
use Fd\TablaBundle\Form\BarrioType;
use Fd\TablaBundle\Form\BarrioFilterType;

/**
 * Barrio controller.
 *
 * @Route("/barrio")
 */
class BarrioController extends Controller
{
    /**
     * Lists all Barrio entities.
     *
     * @Route("/", name="barrio")
     * @Template()
     */
    public function indexAction()
    {
        list($filterForm, $queryBuilder) = $this->filter();

        list($entities, $pagerHtml) = $this->paginator($queryBuilder);

    
        return array(
            'entities' => $entities,
            'pagerHtml' => $pagerHtml,
            'filterForm' => $filterForm->createView(),
        );
    }

    /**
    * Create filter form and process filter request.
    *
    */
    protected function filter()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $filterForm = $this->createForm(new BarrioFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('TablaBundle:Barrio')->createQueryBuilder('e');
    
        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
            $session->remove('BarrioControllerFilter');
        }
    
        // Filter action
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'filter') {
            // Bind values from the request
            $filterForm->bind($request);

            if ($filterForm->isValid()) {
                // Build the query from the given form object
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                // Save filter to session
                $filterData = $filterForm->getData();
                $session->set('BarrioControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('BarrioControllerFilter')) {
                $filterData = $session->get('BarrioControllerFilter');
                $filterForm = $this->createForm(new BarrioFilterType(), $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        }
    
        return array($filterForm, $queryBuilder);
    }

    /**
    * Get results from paginator and get paginator view.
    *
    */
    protected function paginator($queryBuilder)
    {
        // Paginator
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $currentPage = $this->getRequest()->get('page', 1);
        $pagerfanta->setCurrentPage($currentPage);
        $entities = $pagerfanta->getCurrentPageResults();
    
        // Paginator - route generator
        $me = $this;
        $routeGenerator = function($page) use ($me)
        {
            return $me->generateUrl('barrio', array('page' => $page));
        };
    
        // Paginator - view
        $translator = $this->get('translator');
        $view = new TwitterBootstrap3View();
        $pagerHtml = $view->render($pagerfanta, $routeGenerator, array(
            'proximity' => 3,
            'prev_message' => $translator->trans('views.index.pagprev', array(), 'JordiLlonchCrudGeneratorBundle'),
            'next_message' => $translator->trans('views.index.pagnext', array(), 'JordiLlonchCrudGeneratorBundle'),
        ));
    
        return array($entities, $pagerHtml);
    }
    
    /**
     * Finds and displays a Barrio entity.
     *
     * @Route("/{id}/show", name="barrio_show")
     * @ParamConverter("entity", class="TablaBundle:Barrio")
     * @Template()
     */
    public function showAction($id)
    {

        $deleteForm = $this->createDeleteForm($entity->getId());

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Barrio entity.
     *
     * @Route("/new", name="barrio_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Barrio();
        $form   = $this->createForm(new BarrioType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Barrio entity.
     *
     * @Route("/create", name="barrio_create")
     * @Method("post")
     * @Template("TablaBundle:Barrio:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Barrio();
        $request = $this->getRequest();
        $form    = $this->createForm(new BarrioType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.create.success');

            return $this->redirect($this->generateUrl('barrio_show', array('id' => $entity->getId())));        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
    /**
     * Displays a form to edit an existing Barrio entity.
     *
     * @Route("/{id}/edit", name="barrio_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TablaBundle:Barrio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Barrio entity.');
        }

        $editForm = $this->createForm(new BarrioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Barrio entity.
     *
     * @Route("/{id}/update", name="barrio_update")
     * @Method("post")
     * @Template("TablaBundle:Barrio:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TablaBundle:Barrio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Barrio entity.');
        }

        $editForm   = $this->createForm(new BarrioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.update.success');

            return $this->redirect($this->generateUrl('barrio_edit', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Barrio entity.
     *
     * @Route("/{id}/delete", name="barrio_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TablaBundle:Barrio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Barrio entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('barrio'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
