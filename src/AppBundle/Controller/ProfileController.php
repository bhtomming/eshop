<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Product controller.
 *
 * @Route("/profile")
 */
class ProfileController extends Controller
{
    /**
     * @Route("/", name="profile")
     */
    public function indexAction()
    {
        return $this->render('Profile/index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/show", name="user_show")
     */
    public function showAction()
    {
        return $this->render('Profile/show.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/edit")
     */
    public function editAction()
    {
        return $this->render('Profile/edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/consume/list", name="profile_consume")
     */
    public function consumeListAction(){
        return $this->render('trade/list.html.twig',array(
        ));
    }

    /**
     * @Route("/commission/list", name="profile_commission")
     */
    public function commissionAction(){
        $user = $this->getUser();
        if(!$user instanceof User){
            return $this->redirectToRoute('homePage');
        }
        $commissions = $user->getCommission();
        return $this->render('commission/list.html.twig',array(
            'commissions' => $commissions
        ));
    }

    /**
     * @Route("/shares/list", name="profile_shares")
     */
    public function sharesAction(){
        $user = $this->getUser();
        if(!$user instanceof User){
            return $this->redirectToRoute('homePage');
        }
        $shares = $user->getShares();
        return $this->render('shares/list.html.twig',array(
            'shares' => $shares
        ));
    }

    /**
     * @Route("/recharge/list", name="profile_recharge_list")
     */
    public function rechargeListAction(){
        return $this->render('recharge/list.html.twig',array(
        ));
    }

    /**
     * @Route("/cash/list", name="profile_cash_list")
     */
    public function cashListAction(){
        return $this->render('cash/list.html.twig',array(
        ));
    }

}
