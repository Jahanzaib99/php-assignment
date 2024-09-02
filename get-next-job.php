<?php

require_once 'QueueManager.php';

$queueManager = new QueueManager(['maintenance', 'reject', 'purchase']);

if (isset($_GET['queue'])) {
    $queue = $_GET['queue'];
    echo $queueManager->getNextJob($queue);
} else {
    http_response_code(400);
    echo 'Invalid parameters';
}
