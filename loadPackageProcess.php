<?php
require "connection.php";
$result = Database::search("SELECT * FROM package WHERE hotel_id='" . $_GET['id'] . "'");

?>
<option value="0">Select</option>
<?php
while ($data = $result->fetch_assoc()) {
?>
    <option value="<?= $data['id'] ?>"><?= $data['package'] ?> - Rs <?= $data['price'] ?>.00</option>
<?php } ?>