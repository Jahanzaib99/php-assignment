<?php

require_once 'QueueManager.php';

$queueManager = new QueueManager(['maintenance', 'reject', 'purchase']);

if (isset($_GET['queue']) && isset($_GET['job'])) {
    $queue = $_GET['queue'];
    $job = $_GET['job'];
    $queueManager->addJob($queue, $job);
    echo "Job added";
} else {
    http_response_code(400);
    echo 'Invalid parameters';
}
