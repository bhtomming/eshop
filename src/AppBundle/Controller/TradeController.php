<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\10\5 0005
 * Time: 17:46
 */

namespace AppBundle\Controller;


use AppBundle\Entity\ConsumeLog;
use AppBundle\Entity\Product;
use AppBundle\Entity\User;
use AppBundle\Form\ConsumeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TradeController
 * @Route("/trade")
 */
class TradeController extends Controller
{
    /**
     * @Route("/create", name="trade_new")
     */
    public function createAction(Request $request){
        $id = $request->query->get('id');
        $number = $request->request->get('number');
        if(!preg_match('/^[0-9]$/',$id) || !preg_match('/^[0-9]$/',$number)){
            return $this->createNotFoundException('请提交正确的数据');
        }
        $submitToken = $request->request->get('token');
        if(!$this->isCsrfTokenValid('cart-number',$submitToken)){
            return $this->createNotFoundException('数据验证失败');
        }
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($id);
        $userServer = $this->get('app.user_server');
        $user = $this->getUser();
        if(!$user instanceof User){
            return $this->redirectToRoute('fos_user_security_login');
        }
        if(($user->getAmount() - $product->getPrice() * $number) < 0){
            return $this->redirectToRoute('recharge_new');
        }
        $consume = $userServer->buy($product,$number,$user);
        //$consume = $userServer->update($user);
        /*$em->persist($consume);
        $em->flush();*/

        return $this->render('/trade/new.html.twig',array(
            'consume' => $consume,
        ));
    }

    /**
     * @Route("/list", name="trade_list")
     */
    public function listAction(){
        return $this->render('/trade/list.html.twig');
    }

}