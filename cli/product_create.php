<?php declare(strict_types=1);
require_once (__DIR__ . '/../src/Storage/Writer.php');
require_once (__DIR__ . '/../src/Event/Writer.php');
/*use \App\Client\Helper;
$object = new Helper;
?>
    <form action="<?=$object->getClientPath();?>product_create.php">
        <label for="id">ID:</label><br>
        <input type="text" id="id" name="id"><br>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name">
        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price">
    </form>
<?php*/
use App\Storage\Writer;
use App\Event\Writer as EventWriter;

if(!empty($argv)) {
    $id = $argv[1] ?? '';
    $name = $argv[2] ?? '';
    $price = $argv[3] ?? '';
    if(!empty($id) && !empty($name) && !empty($price)) {
        $writer = new Writer;
        $value = $argv[1] . ' ' . $argv[2] . ' ' . $argv[3];
        $writer->create($id, $value);
        $eventValue = 'Product created: ' . $id . ' ' . $name . ' ' . $price . PHP_EOL;
        (new EventWriter)->create('event_worker.php', $eventValue);
    }
}