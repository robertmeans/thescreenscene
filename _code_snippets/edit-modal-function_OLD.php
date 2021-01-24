<?php

// be sure to clean up all 3 pages at: 
// if ((event.target
// ...at the end of each one is an extra || 
// and then run through: https://javascript-minifier.com/
for ($row_count = 0; $row_count < 24; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "var modal_" . $id_count . " = document.getElementById(\"modal_" . $id_count . "\");<br>";
}

echo "<br>";

for ($row_count = 0; $row_count < 24; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "var btn_" . $id_count . " = document.getElementById(\"open_modal_" . $id_count . "\");<br>";
}

echo "var span = document.getElementsByClassName(\"close\");";

echo "<br><br>";

echo "window.addEventListener(\"load\", function(){<br>";

for ($row_count = 0; $row_count < 24; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "btn_" . $id_count . ".onclick = function() { modal_" . $id_count . ".style.display = \"block\"; }<br>";
}

echo "for(var i=0; i < span.length; i++) {<br>";
echo "span[i].onclick = function() {<br>";

for ($row_count = 0; $row_count < 24; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "modal_" . $id_count . ".style.display = \"none\";<br>";
}

echo "} }";

echo "window.onmousedown = function(event) {<br>";
echo "if ((";

for ($row_count = 0; $row_count < 24; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "event.target == modal_" . $id_count . " || ";
}
 
echo ")) {<br>";

for ($row_count = 0; $row_count < 24; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "modal_" . $id_count . ".style.display = \"none\";<br>";
}

echo "<br>";

echo "} } });";

echo "<br><br>// Begin Page 2<br><br>";

for ($row_count = 24; $row_count < 48; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "var modal_" . $id_count . " = document.getElementById(\"modal_" . $id_count . "\");<br>";
}

echo "<br>";

for ($row_count = 24; $row_count < 48; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "var btn_" . $id_count . " = document.getElementById(\"open_modal_" . $id_count . "\");<br>";
}

echo "var span = document.getElementsByClassName(\"close\");";

echo "<br><br>";

echo "window.addEventListener(\"load\", function(){<br>";

for ($row_count = 24; $row_count < 48; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "btn_" . $id_count . ".onclick = function() { modal_" . $id_count . ".style.display = \"block\"; }<br>";
}

echo "for(var i=0; i < span.length; i++) {<br>";
echo "span[i].onclick = function() {<br>";

for ($row_count = 24; $row_count < 48; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "modal_" . $id_count . ".style.display = \"none\";<br>";
}

echo "} }";

echo "window.onmousedown = function(event) {<br>";
echo "if ((";

for ($row_count = 24; $row_count < 48; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "event.target == modal_" . $id_count . " || ";
}
 
echo ")) {<br>";

for ($row_count = 24; $row_count < 48; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "modal_" . $id_count . ".style.display = \"none\";<br>";
}

echo "<br>";

echo "} } });";

echo "<br><br>// Begin Page 3<br><br>";

for ($row_count = 48; $row_count < 72; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "var modal_" . $id_count . " = document.getElementById(\"modal_" . $id_count . "\");<br>";
}

echo "<br>";

for ($row_count = 48; $row_count < 72; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "var btn_" . $id_count . " = document.getElementById(\"open_modal_" . $id_count . "\");<br>";
}

echo "var span = document.getElementsByClassName(\"close\");";

echo "<br><br>";

echo "window.addEventListener(\"load\", function(){<br>";

for ($row_count = 48; $row_count < 72; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "btn_" . $id_count . ".onclick = function() { modal_" . $id_count . ".style.display = \"block\"; }<br>";
}

echo "for(var i=0; i < span.length; i++) {<br>";
echo "span[i].onclick = function() {<br>";

for ($row_count = 48; $row_count < 72; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "modal_" . $id_count . ".style.display = \"none\";<br>";
}

echo "} }";

echo "window.onmousedown = function(event) {<br>";
echo "if ((";

for ($row_count = 48; $row_count < 72; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "event.target == modal_" . $id_count . " || ";
}
 
echo ")) {<br>";

for ($row_count = 48; $row_count < 72; $row_count++){
$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);

	echo "modal_" . $id_count . ".style.display = \"none\";<br>";
}

echo "<br>";

echo "} } });";


?>