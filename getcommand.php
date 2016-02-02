<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','spydergeek','grains');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM commands WHERE cat_id = '".$q."'";
$result = mysqli_query($con,$sql);
echo "<table class=\"table table-bordered\">
<tr>
<th>Command</th>
<th>Description</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td><pre>" . $row['command'] . "</pre></td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>
