<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\10\6 0006
 * Time: 15:17
 */

namespace AppBundle\Services;


use AppBundle\Entity\Businessreport;
use AppBundle\Entity\Commission;
use AppBundle\Entity\ConsumeLog;
use AppBundle\Entity\Product;
use AppBundle\Entity\Shares;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;



class UserServer
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buy(Product $product,$number,User $user){
        $consume = new ConsumeLog();
        $consume->setNumber($number);
        $amount = $product->getPrice() * $number;
        $consume->setAmount($amount);
        $product->setSales($product->getSales() + $number);
        $consume->setProduct($product);
        $shares = $this->shares($amount);
        $consume->setShares($shares);
        $user->addConsume($consume);
        $user->addShares($shares);
        $this->commission($amount,$user);
        $this->report($amount);
        $user->setAmount($user->getAmount() - $consume->getAmount());
        $this->em->persist($user);
        $this->em->flush();
        return $consume;
    }

    public function commission($amount,User $user){
        $parent = $user->getReferee();
        if($parent instanceof User){
            $commission = new Commission();
            $commission->setUser($parent);
            $commission->setDirectConsume($amount);
            $commission->setDirectCommission($amount * 0.1);
            $direct = $parent->getDirect();
            if($direct > 20 && 60 > $direct){
                $commission->setTeamCommission($amount * 0.01);
            }
            if($direct > 60){
                $commission->setTeamCommission($amount * 0.005);
            }
            $parent->addAmount( $commission->getDirectCommission() + $commission->getTeamCommission());
            $parent->addCommission($commission);
            $reparent = $parent->getReferee();
            if($reparent instanceof User){
                $recomm = new Commission();
                $recomm->setIndirectConsume($amount);
                $recomm->setIndirectCommission($amount * 0.05);
                $reparent->addCommission($recomm);
                $reparent->addAmount($recomm->getIndirectCommission());
            }
        }
    }

    public function shares($amount){
        $share = new Shares();
        $share->setShares($amount * 10);
        return $share;
    }

    public function report($amount){
        $nowdate = new \DateTime('now');
        $report = $this->em->getRepository(Businessreport::class)->findOneBy(['no'=>"MY{$nowdate->format('Ymd')}"]);
        if(!$report instanceof Businessreport){
            $report = new Businessreport();
        }
        $report->addTurnover($amount);
        $report->addShares($amount * 10);
        $report->addSmallDish($amount * 0.1);
        $this->em->persist($report);
        $this->em->flush();
    }

}