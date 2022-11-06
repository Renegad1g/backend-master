<?php declare(strict_types=1);
require_once (__DIR__ . '/../src/Storage/Writer.php');
require_once (__DIR__ . '/../src/Storage/Helper.php');
require_once (__DIR__ . '/../src/Storage/Reader.php');
require_once (__DIR__ . '/../src/Event/Writer.php');
use \App\Storage\Writer;
use \App\Storage\Helper;
use \App\Storage\Reader;
use \App\Event\Writer as EventWriter;

if(!empty($argv)) {
    $id = $argv[1] ?? '';
    $name = $argv[2] ?? '';
    $price = $argv[3] ?? '';
    if(!empty($id) && !empty($name) && !empty($price)) {
        $reader = new Reader;
        $oldData = $reader->read($id);
        $value = $argv[1] . ' ' . $argv[2] . ' ' . $argv[3];
        $helper = new Helper;
        $difference = $helper->differenceOfData($oldData, $value);
        if(!empty($difference)) {
            $writer = new Writer;
            $writer->update($id, $value);
            $eventValue = 'Product updated: ';
            foreach($difference as $dif) {
                $eventValue .= $dif . PHP_EOL;
            }
            (new EventWriter)->create('event_worker.php', $eventValue);
        }
    }
}