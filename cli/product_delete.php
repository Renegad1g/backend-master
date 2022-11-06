<?php declare(strict_types=1);
require_once (__DIR__ . '/../src/Storage/Writer.php');
require_once (__DIR__ . '/../src/Event/Writer.php');
use \App\Storage\Writer;
use \App\Event\Writer as EventWriter;

if(!empty($argv)) {
    $id = $argv[1] ?? '';
    if(!empty($id)) {
        $writer = new Writer;
        $writer->delete($id);
        $eventValue = 'Product deleted: ' . $id  . PHP_EOL;
        (new EventWriter)->create('event_worker.php', $eventValue);
    }
}