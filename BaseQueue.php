<?php

class BaseQueue
{
    protected $queueName;
    protected $filePath;

    public function __construct($queueName)
    {
        $this->queueName = $queueName;
        $this->filePath = __DIR__ . '/queues/' . $queueName . '.php';
        if (!file_exists($this->filePath)) {
            // Initialize an empty array if the file does not exist
            file_put_contents($this->filePath, '<?php return [];');
        }
    }

    public function addJob($job)
    {
        $jobs = $this->getJobs();
        $jobs[] = $job;
        file_put_contents($this->filePath, '<?php return ' . var_export($jobs, true) . ';');
        return 'Job added to ' . $this->queueName . ' queue.';
    }

    public function getNextJob()
    {
        $jobs = $this->getJobs();
        if (empty($jobs)) {
            return null;
        }
        $job = array_shift($jobs);
        file_put_contents($this->filePath, '<?php return ' . var_export($jobs, true) . ';');
        return $job;
    }

    protected function getJobs()
    {
        $jobs = include $this->filePath;
        return is_array($jobs) ? $jobs : [];
    }
}
