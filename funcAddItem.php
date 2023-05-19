<?php
function add_item(){
	if ($_SESSION['status'] == 1) {
		global $link;
		$name = $_POST['name'] ?? '';
		$linksite = $_POST['linksite'] ?? '';
		$formattedText = "<a href='$linksite'>$name</a>";
		$id_cat = $_POST['id_cat'] ?? '';
		$ed_izm = $_POST['ed_izm'] ?? '';
		$price = $_POST['price'] ?? '';
		$comments = $_POST['comments'] ?? '';

		$stmt = $link->prepare("INSERT INTO active (name_act, id_cat, ed_izm, price, comments, linksite, name) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssss", $formattedText, $id_cat, $ed_izm, $price, $comments, $linksite, $name);
		$stmt->execute();

		echo '<meta http-equiv="refresh" content="0;URL=active.php">';
		die();
	}
}
?>
