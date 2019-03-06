<?PHP
header("Content-Type: text/html; charset=utf-8");
include_once 'SSQL.php';
$ssql = new SSQL("config.json");
if (!$ssql->ping()) {
	echo ($ssql->get_errors(true, true));
}else{
	echo "Execute result:";
	var_dump($ssql->query("SELECT * FROM test_table;"));
	if ($ssql->has_error()){
		echo ($ssql->get_errors(true, true));
	}else{
		echo "<br>affected_rows:";
		echo $ssql->affected_rows;
		echo "<br>insert_id:";
		if (is_array($ssql->insert_id)) {
			echo var_dump($ssql->insert_id);
		}else{
			echo $ssql->insert_id;
		}
		echo "<br>num_rows:";
		echo $ssql->num_rows;
		echo "<br>column number:";
		echo $ssql->column_num;
		echo "<br>column names:";
		echo json_encode($ssql->column_names, JSON_UNESCAPED_UNICODE);
		echo "<br>";
		echo json_encode($ssql->data_table);
	}
}
?>