<?php

// !!!  be sure to clean up all 3 pages at: 
// if ((event.target  
// ...at the end of each one is an extra || 
// and then run through: https://javascript-minifier.com/
for ($row_count = 0; $row_count < 72; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "if (document.getElementById(\"modal_" . $id_count . "\") !== null) {var modal_" . $id_count . " = document.getElementById(\"modal_" . $id_count . "\");}<br>";
}

echo "<br>";




for ($row_count = 0; $row_count < 72; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "if (document.getElementById(\"btn_" . $id_count . "\") !==null) { var btn_" . $id_count . " = document.getElementById(\"open_modal_" . $id_count . "\");}<br>";
}


echo "var span = document.getElementsByClassName(\"close\");";

echo "<br><br>";

echo "window.addEventListener(\"load\", function(){<br>";

for ($row_count = 0; $row_count < 72; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "if (btn_" . $id_count . ") { modal_" . $id_count . ".onclick = function() { modal_" . $id_count . ".style.display = \"block\"; } }<br>";
}

echo "for(var i=0; i < span.length; i++) {<br>";
echo "span[i].onclick = function() {<br>";

for ($row_count = 0; $row_count < 72; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "if (modal_" . $id_count . ") { modal_" . $id_count . ".style.display = \"none\"; }<br>";
}

echo "} }";

echo "window.onmousedown = function(event) {<br>";
echo "if ((";

for ($row_count = 0; $row_count < 72; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	$foo = "event.target == modal_" . $id_count . " || ";
	// $bar = substr($foo, 0, -4);
	echo $foo;
}
 
echo ")) {<br>";

for ($row_count = 0; $row_count < 72; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "modal_" . $id_count . ".style.display = \"none\";<br>";
}

echo "<br>";

echo "} } });";










?>