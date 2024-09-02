<?php

use PHPUnit\Framework\TestCase;

require_once 'Queue.php';

class QueueTest extends TestCase
{
    private $queue;

    protected function setUp(): void
    {
        parent::setUp();
        $this->queue = new Queue('testQueue');
    }

    public function testAddJob()
    {
        $this->queue->addJob('test job');
        $this->assertEquals('test job', $this->queue->getNextJob());
    }

    public function testGetNextJob()
    {
        $this->queue->addJob('first job');
        $this->queue->addJob('second job');
        $this->assertEquals('first job', $this->queue->getNextJob());
        $this->assertEquals('second job', $this->queue->getNextJob());
    }

    public function testQueueEmpty()
    {
        $this->assertNull($this->queue->getNextJob());
    }
}
