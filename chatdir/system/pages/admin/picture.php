<?php
require_once('../../config_session.php');

?>
<?php echo elementTitle('camera', $lang['picture_logs']); ?>
<div class="page_full">
	<div class="page_element">
<?php
echo "<table style='border: solid 1px black;'>";
  echo "<tr><th>van</th><th>Bestandsnaam</th></tr>";

class TableRows extends RecursiveIteratorIterator {
     function __construct($it) {
         parent::__construct($it, self::LEAVES_ONLY);
     }

     function current() {
         return "<td style='width: 250px; border: 1px solid black;'>" . parent::current(). "</td>";
     }

     function beginChildren() {
         echo "<tr>";
     }
}

$servername = "localhost";
$username = "root";
$password = "19216815Chris!";
$dbname = "admin_boom";

try {
     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $stmt = $conn->prepare("SELECT file_user, file_name FROM boom_upload ORDER BY id DESC LIMIT 1200");
     $stmt->execute();

     // set the resulting array to associative
     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

     foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
         echo $v;
     }
}
catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?> 
	<div class="page_element">
		<div id="ip_list">
			<?php echo $list_ip; ?>
				<div class="clear"></div>
			</div>
		</div>
	</div>

		</div>
	</div>
</div>




