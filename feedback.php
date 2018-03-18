<?php

require_once 'resource/session.php';
require_once 'resource/database.php';
include_once 'partials/header.php';

$sql = "SELECT * FROM feedback";


$statement = $db->prepare($sql);
$statement->execute();

echo "<table class = 'table table-hover'><th>Sender Name</th><th>Sender Email</th><th>Message</th>";

while ($row = $statement->fetch()) {
	$sender_name = $row['sender_name'];
	$sender_email = $row['sender_email'];
	$sender_message = $row['message'];

	echo "<tr><td>".$sender_name."</td><td>".$sender_email."</td><td>".$sender_message."</td></tr>";
}

echo "</table>";
include_once 'partials/footer.php';