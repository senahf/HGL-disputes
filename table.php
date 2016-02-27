<head>
<meta http-equiv="refresh" content="20">
</head>
<table class="striped centered bordered responsive-table">
          <thead>
            <tr>
              <th data-field="id">Case #</th>
              <th data-field="name">Priority</th>
              <th data-field="name">Time</th>
              <th data-field="price">Discord Name</th>
              <th data-field="price">Comments</th>
              <th data-field="price">Status</th>
              <th data-field="price">Admin</th>
            </tr>
          </thead>
          <tbody>
            <?php
$sql = 'SELECT id, priority, name, issue, status, admin, `date` FROM `issues` WHERE `status` < 3 AND `verified` = 1 ORDER BY coalesce(`priority`, 2) DESC, `date` ASC';
$rs = $conn->query($sql);
if ($rs === false) {
	die("somethin rong b0ss");
} else {
	$arr = $rs->fetch_all(MYSQLI_ASSOC);
	$rows_returned = $rs->num_rows;
}
foreach ($arr as $row) {
	$time = strtotime($row['date']);
	$time = date("m/d/y g:i A", $time);
	if ($row['priority'] >= 4 && $row['status'] == 1) {echo "<tr class=\"red white-text\">";} elseif ($row['status'] == 2) {echo "<tr class=\"blue white-text\">";} else {echo "<tr>";}
	echo "<td>" . $row['id'] . "</td>
              <td>" . $row['priority'] . "</td>
              <td>" . $time . "</td>
              <td>" . $row['name'] . "</td>
              <td>" . eye21($row['issue'], 77) . "</td>";
	if ($row['status'] == 1) {echo '<td>AWAITING ADMIN</td>';} elseif ($row['status'] == 3) {echo "<td>Finished</td>";} else {echo "<td>Being Handled</td>";}
	if ($row['status'] > 1) {echo '<td>' . $row['admin'] . '</td>';} else {echo '<td>-</td>';}
	echo "</tr>";
}
if ($rows_returned < 11) {
	echo str_repeat("<tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>-</td>
            </tr>", 10 - $rows_returned);
}
?>
          </tbody>
        </table>