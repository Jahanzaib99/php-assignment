<?php

require_once 'BaseQueue.php';

class QueueManager
{
    private $queues = [];

    public function __construct(array $queueNames)
    {
        foreach ($queueNames as $queueName) {
            $this->queues[$queueName] = new BaseQueue($queueName);
        }
    }

    public function addJob($queueName, $job)
    {
        if (!isset($this->queues[$queueName])) {
            return 'Queue not found';
        }
        return $this->queues[$queueName]->addJob($job);
    }

    public function getNextJob($queueName)
    {
        if (!isset($this->queues[$queueName])) {
            return 'Queue not found';
        }
        return $this->queues[$queueName]->getNextJob();
    }
}
