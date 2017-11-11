<?php
namespace FrontBundle\Command;

use FrontBundle\StreamRequest\Processor;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProcessRequestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('request:process')
            ->setDescription('Processes requests')
            ->setHelp('This command will start processing requests')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $processor = $this->getRequestProcessor();
        $processor->processRequests();
    }
    
    private function getRequestProcessor() : Processor
    {
        return $this->getContainer()->get('front.request_processor');
    }
}