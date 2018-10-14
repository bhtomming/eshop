<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\10\10 0010
 * Time: 17:40
 */

namespace AppBundle\Services;


use AppBundle\Entity\Businessreport;
use AppBundle\Entity\ConsumeLog;
use AppBundle\Entity\Shares;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class DividendServer
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function start(){
        $day = new \DateTime('-1 days');
        $report = $this->em->getRepository(Businessreport::class)->findOneBy(['no'=>"MY{$day->format('Ymd')}"]);
        if(!$report instanceof Businessreport){
            return "can not find report.";
        }
        if($report->getPreshare() == 0){
            $newReport = new Businessreport();
            $newReport->setShares($report->getSmallDish());
            $newReport->setShares($report->getShares());
            $this->em->persist($newReport);
            $this->em->flush();
            return "no share create a new report";
        }
        $consumes = $this->em->getRepository(ConsumeLog::class)->findBy(['status' => ConsumeLog::PAYING]);
        if(!isset($consumes)){
            return "can not find consume.";
        }
        $profit = $report->getSmallDish();
        foreach ($consumes as $consume){
            if($consume instanceof ConsumeLog){
                $dividend = $report->getPreshare() * $consume->getAmount() * 0.1;
                $amount = $consume->getAmount();
                $profit -= $dividend;
                $report->setProfit($profit);
                $report->setUpdatedAt(new \DateTime('now'));
                $afterAmount = $consume->getAfterBonus();
                if($dividend + $afterAmount >= $amount){  //获得分红等于消费额
                    $dividend = $amount - $afterAmount;
                    $consume->setAfterBonus($amount);
                    $consume->setStatus(ConsumeLog::PAYEND); //设置停止分红
                    $report->subtractShares($consume->getShares()); //报表中减去满额分红的份数
                }
                $share = new Shares();
                $share->setBonus($dividend);
                $share->setShares($amount * 10);
                $user = $consume->getUser();
                $user->addAmount($dividend); //用户获得分红
                $share->setUser($user);
                $share->setConsume($consume);
                $this->em->persist($share);
                $this->em->flush();
            }
        }
        return "complete";
    }

}