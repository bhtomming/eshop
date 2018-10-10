<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\10\6 0006
 * Time: 14:48
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CartController
 * @Route("/cart")
 */
class CartController extends Controller
{
    /**
     * @Route("/show", name="cart_show")
     */
    public function showAction(Request $request){
        $id = $request->query->get('id');
        $number = $request->request->get('number');
        if(!preg_match('/^[0-9]$/',$id) || !preg_match('/^[0-9]$/',$number)){
            return $this->createNotFoundException('请提交正确的数据');
        }
        $submitToken = $request->request->get('token');
        if(!$this->isCsrfTokenValid('data-number',$submitToken)){
            return $this->createNotFoundException('数据验证失败');
        }
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($id);

        return $this->render('/cart/show.html.twig',array(
            'product' => $product,
            'number' => $number,
        ));
    }

}