<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\10\11 0011
 * Time: 8:47
 */

namespace AppBundle\Command;


use AppBundle\Services\DividendServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DividendCommand extends Command
{

    private $dvd;
    public function __construct(DividendServer $dvd)
    {
        $this->dvd = $dvd;
        parent::__construct();
    }

    public function configure()
    {
        $this->setName('dividend.start');
        $this->setDescription("start dividend for all user");
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('start to dividend ...');
        $output->writeln($this->dvd->start());
        $output->writeln('dividend end');
    }

}