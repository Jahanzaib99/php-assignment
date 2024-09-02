<?php

class Queue extends BaseQueue
{
    protected function initializeQueue()
    {
        $queueFile = $this->getQueueFile();
        if (file_exists($queueFile)) {
            $data = file_get_contents($queueFile);
            if ($data !== false) {
                $unserializedData = @unserialize($data);
                if ($unserializedData !== false) {
                    $this->queue = $unserializedData;
                } else {
                    $this->queue = new SplQueue();
                }
            } else {
                $this->queue = new SplQueue();
            }
        } else {
            $this->queue = new SplQueue();
        }
    }
}
