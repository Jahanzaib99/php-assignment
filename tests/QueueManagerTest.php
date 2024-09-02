<?php

use PHPUnit\Framework\TestCase;

require_once 'QueueManager.php';

class QueueManagerTest extends TestCase
{
    private $queueManager;

    protected function setUp(): void
    {
        parent::setUp();
        // Initialize with existing queue names
        $this->queueManager = new QueueManager(['maintenance', 'reject', 'purchase']);
    }

    public function testAddJob()
    {
        $this->assertEquals('Job added to maintenance queue.', $this->queueManager->addJob('maintenance', 'test job'));
    }

    public function testGetNextJob()
    {
        $this->queueManager->addJob('maintenance', 'first job');
        echo $this->queueManager->getNextJob('maintenance');
        $this->assertEquals('first job', $this->queueManager->getNextJob('maintenance'));
    }

    public function testQueueNotFound()
    {
        $this->assertEquals('Queue not found', $this->queueManager->addJob('unknown', 'test job'));
    }
}
