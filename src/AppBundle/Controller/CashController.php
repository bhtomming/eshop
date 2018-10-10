<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\10\5 0005
 * Time: 17:05
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Cash;
use AppBundle\Entity\User;
use AppBundle\Form\CashType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cash")
 */
class CashController extends Controller
{
    /**
     * @Route("/create", name="cash_new")
     */
    public function newAction(Request $request){
        $cash = new Cash();
        $form = $this->createForm(CashType::class, $cash);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            if(!$user instanceof User){
                return $this->redirectToRoute('homepage');
            }
            $amount = $user->getAmount();
            if($cash->getAmount() > $amount || $amount < $cash->getConditions()){
                return $this->redirectToRoute('cash_new');
            }
            $user->setAmount($amount - $cash->getAmount());
            $cash->setUser($user);
            $em->persist($cash);
            $em->flush();

            return $this->redirectToRoute('profile_cash_list');
        }

        return $this->render('cash/new.html.twig', array(
            'cash' => $cash,
            'form' => $form->createView(),
        ));
    }

}