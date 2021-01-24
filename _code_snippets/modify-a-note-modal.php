<?php

// be sure to clean up all 3 pages at: 
// if ((event.target  --> (may have just cleaned this up - lines 60-62 $foo & $bar substr())
// ...at the end of each one is an extra || 
// and then run through: https://javascript-minifier.com/
for ($row_count = 0; $row_count < 20; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "if (document.getElementById(\"" . $id_count . "_modify-modal\") !== null) { var note_" . $id_count . " = document.getElementById(\"" . $id_count . "_modify-modal\");}<br>";

}

echo "<br>";

for ($row_count = 0; $row_count < 20; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "if (document.getElementById(\"" . $id_count . "_modify-note\") !== null) { var note_btn_" . $id_count . " = document.getElementById(\"" . $id_count . "_modify-note\"); }<br>";

}

echo "var spanz = document.getElementsByClassName(\"closer\");";

echo "<br><br>";

echo "window.addEventListener(\"load\", function(){<br>";

for ($row_count = 0; $row_count < 20; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "if (note_" . $id_count . ") { note_btn_" . $id_count . ".onclick = function() { note_" . $id_count . ".style.display = \"block\"; } }<br>";

}

echo "for(var z=0; z < spanz.length; z++) {<br>";
echo "spanz[z].onclick = function() {<br>";

for ($row_count = 0; $row_count < 20; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "if (note_" . $id_count . ") { note_" . $id_count . ".style.display = \"none\"; }<br>";

}

echo "} }";

echo "window.onmousedown = function(event) {<br>";
echo "if ((";

for ($row_count = 0; $row_count < 20; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	$foo = "event.target == note_" . $id_count . " || ";
	// $bar = substr($foo, 0, -4);
	echo $foo;
	// echo $foo;
}
 
echo ")) {<br>";

for ($row_count = 0; $row_count < 20; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "note_" . $id_count . ".style.display = \"none\";<br>";
}

echo "<br>";

echo "} } });";










?>