<?php

namespace AppBundle\Controller;

use AppBundle\Entity\RechargeLog;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Rechargelog controller.
 *
 * @Route("/recharge")
 */
class RechargeLogController extends Controller
{
    /**
     * Lists all rechargeLog entities.
     *
     * @Route("/", name="recharge_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rechargeLogs = $em->getRepository('AppBundle:RechargeLog')->findAll();

        return $this->render('rechargelog/index.html.twig', array(
            'rechargeLogs' => $rechargeLogs,
        ));
    }

    /**
     * Creates a new rechargeLog entity.
     *
     * @Route("/new", name="recharge_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $rechargeLog = new Rechargelog();
        $form = $this->createForm('AppBundle\Form\RechargeLogType', $rechargeLog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            if(!$user instanceof User){
                return $this->redirectToRoute('homepage');
            }
            $user->setAmount($rechargeLog->getAmount() + $user->getAmount());
            $rechargeLog->setAfterAmount($user->getAmount());
            $rechargeLog->setUser($user);
            $em->persist($rechargeLog);
            $em->flush();

            return $this->redirectToRoute('profile_recharge_list');
        }

        return $this->render('recharge/new.html.twig', array(
            'rechargeLog' => $rechargeLog,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a rechargeLog entity.
     *
     * @Route("/{id}", name="recharge_show")
     * @Method("GET")
     */
    public function showAction(RechargeLog $rechargeLog)
    {


        return $this->render('rechargelog/show.html.twig', array(
            'rechargeLog' => $rechargeLog,
        ));
    }

    /**
     * Displays a form to edit an existing rechargeLog entity.
     *
     * @Route("/{id}/edit", name="recharge_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, RechargeLog $rechargeLog)
    {

        $editForm = $this->createForm('AppBundle\Form\RechargeLogType', $rechargeLog);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recharge_edit', array('id' => $rechargeLog->getId()));
        }

        return $this->render('rechargelog/edit.html.twig', array(
            'rechargeLog' => $rechargeLog,
            'edit_form' => $editForm->createView(),
        ));
    }


}
