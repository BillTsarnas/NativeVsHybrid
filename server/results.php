<!DOCTYPE html>

<html>



<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php
    
	
    $conn       = new mysqli( '127.0.0.1', 'root', '***', 'NativeVsHybrid' );
	
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
    
	
	$query_native = "SELECT * from native";
	
	$query_hybrid = "SELECT * from hybrid";
	
	$result_native = $conn->query($query_native);
	
	$result_hybrid = $conn->query($query_hybrid);
	
	$query_native_avg = "SELECT task, AVG(execution) AS average_time from native GROUP BY task";
	
	$query_hybrid_avg = "SELECT task, AVG(execution) AS average_time from hybrid GROUP BY task";
	
	$result_native_avg = $conn->query($query_native_avg);
	
	$result_hybrid_avg = $conn->query($query_hybrid_avg);
	
	/*---------------HYBRID PARTICIPATION STATS-------------------------------------------------------------*/
	
	$query_hybrid_percentage_GMAP_INIT = 'select os_version, count(*) as count_specific_os,
		(select count(*) from (select os_version from hybrid where task="GMAP_INIT") as x) as count_total_os 
		from (select os_version from hybrid where task="GMAP_INIT") as t 
		group by os_version';
		
	$query_hybrid_percentage_GET_JSON = 'select os_version, count(*) as count_specific_os,
		(select count(*) from (select os_version from hybrid where task="GET_JSON") as x) as count_total_os 
		from (select os_version from hybrid where task="GET_JSON") as t 
		group by os_version';
		
	$query_hybrid_percentage_POST_JSON = 'select os_version, count(*) as count_specific_os,
		(select count(*) from (select os_version from hybrid where task="POST_JSON") as x) as count_total_os 
		from (select os_version from hybrid where task="POST_JSON") as t 
		group by os_version';
	
	$query_hybrid_percentage_LEAFMAP_INIT = 'select os_version, count(*) as count_specific_os,
		(select count(*) from (select os_version from hybrid where task="LEAFMAP_INIT") as x) as count_total_os 
		from (select os_version from hybrid where task="LEAFMAP_INIT") as t 
		group by os_version';
		
	$query_hybrid_percentage_SCR_CHNG = 'select os_version, count(*) as count_specific_os,
		(select count(*) from (select os_version from hybrid where task="SCR_CHNG") as x) as count_total_os 
		from (select os_version from hybrid where task="SCR_CHNG") as t 
		group by os_version';
		
	$result_hybrid_percentage_GMAP_INIT = $conn->query($query_hybrid_percentage_GMAP_INIT);
	
	$result_hybrid_percentage_GET_JSON = $conn->query($query_hybrid_percentage_GET_JSON);
	
	$result_hybrid_percentage_POST_JSON = $conn->query($query_hybrid_percentage_POST_JSON);
	
	$result_hybrid_percentage_LEAFMAP_INIT = $conn->query($query_hybrid_percentage_LEAFMAP_INIT);
	
	$result_hybrid_percentage_SCR_CHNG = $conn->query($query_hybrid_percentage_SCR_CHNG);
	
	
	
	
	/*---------------NATIVE PARTICIPATION STATS-------------------------------------------------------------*/
	
	$query_native_percentage_GMAP_INIT = 'select os_version, count(*) as count_specific_os,
		(select count(*) from (select os_version from native where task="GMAP_INIT") as x) as count_total_os 
		from (select os_version from native where task="GMAP_INIT") as t 
		group by os_version';
		
	$query_native_percentage_GET_JSON = 'select os_version, count(*) as count_specific_os,
		(select count(*) from (select os_version from native where task="GET_JSON") as x) as count_total_os 
		from (select os_version from native where task="GET_JSON") as t 
		group by os_version';
		
	$query_native_percentage_POST_JSON = 'select os_version, count(*) as count_specific_os,
		(select count(*) from (select os_version from native where task="POST_JSON") as x) as count_total_os 
		from (select os_version from native where task="POST_JSON") as t 
		group by os_version';
		
	$query_native_percentage_SCR_CHNG = 'select os_version, count(*) as count_specific_os,
		(select count(*) from (select os_version from native where task="SCR_CHNG") as x) as count_total_os 
		from (select os_version from native where task="SCR_CHNG") as t 
		group by os_version';
		
	$result_native_percentage_GMAP_INIT = $conn->query($query_native_percentage_GMAP_INIT);
	
	$result_native_percentage_GET_JSON = $conn->query($query_native_percentage_GET_JSON);
	
	$result_native_percentage_POST_JSON = $conn->query($query_native_percentage_POST_JSON);
	
	$result_native_percentage_SCR_CHNG = $conn->query($query_native_percentage_SCR_CHNG);
	
	
		
	
	
	
	
?>
</head>



<body>
<h2>Execution results (average)</h2>
<table class="table table-bordered">
<thead>
      <tr>
        <th bgcolor="#3399ff">Native task</th>
        <th bgcolor="#3399ff">Native execution time</th>
      </tr>
</thead>

<tbody>


      
<?php while($row_native_avg = $result_native_avg->fetch_assoc()){ ?>
		<tr>
        <th><?php echo $row_native_avg['task']; ?></th>
        <th><?php echo $row_native_avg['average_time']; ?></th>
		</tr>
<?php } ?>

</tbody>
</table>
<!--------------------------------------------------------------->
<table class="table table-bordered">
<thead>
      <tr>
        <th bgcolor="#3399ff">Hybrid task</th>
        <th bgcolor="#3399ff">Hybrid execution time</th>
      </tr>
</thead>

<tbody>


      
<?php while($row_hybrid_avg = $result_hybrid_avg->fetch_assoc()){ ?>
		<tr>
        <th><?php echo $row_hybrid_avg['task']; ?></th>
        <th><?php echo $row_hybrid_avg['average_time']; ?></th>
		</tr>
<?php } ?>

</tbody>
</table>

<h2>Participant percentages by Operating System (Native)</h2>
<!----------------------------!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--------------------------------->
<table class="table table-bordered">
<thead>
      <tr>
        <th bgcolor="#3399ff">Operating System</th>
        <th bgcolor="#3399ff">Participation Percentage(native GET_JSON)</th>
      </tr>
</thead>

<tbody>


      
<?php while($row_native_percentage_GET_JSON = $result_native_percentage_GET_JSON->fetch_assoc()){ ?>
		<tr>
        <th><?php echo $row_native_percentage_GET_JSON['os_version']; ?></th>
        <th><?php echo ($row_native_percentage_GET_JSON['count_specific_os']/$row_native_percentage_GET_JSON['count_total_os'])*100; ?>%</th>
		</tr>
<?php } ?>

</tbody>
</table>

<table class="table table-bordered">
<thead>
      <tr>
        <th bgcolor="#3399ff">Operating System</th>
        <th bgcolor="#3399ff">Participation Percentage(native POST_JSON)</th>
      </tr>
</thead>

<tbody>


      
<?php while($row_native_percentage_POST_JSON = $result_native_percentage_POST_JSON->fetch_assoc()){ ?>
		<tr>
        <th><?php echo $row_native_percentage_POST_JSON['os_version']; ?></th>
        <th><?php echo ($row_native_percentage_POST_JSON['count_specific_os']/$row_native_percentage_POST_JSON['count_total_os'])*100; ?>%</th>
		</tr>
<?php } ?>

</tbody>
</table>

<table class="table table-bordered">
<thead>
      <tr>
        <th bgcolor="#3399ff">Operating System</th>
        <th bgcolor="#3399ff">Participation Percentage (native GMAP_INIT)</th>
      </tr>
</thead>

<tbody>


      
<?php while($row_native_percentage_GMAP_INIT = $result_native_percentage_GMAP_INIT->fetch_assoc()){ ?>
		<tr>
        <th><?php echo $row_native_percentage_GMAP_INIT['os_version']; ?></th>
        <th><?php echo ($row_native_percentage_GMAP_INIT['count_specific_os']/$row_native_percentage_GMAP_INIT['count_total_os'])*100; ?>%</th>
		</tr>
<?php } ?>

</tbody>
</table>

<table class="table table-bordered">
<thead>
      <tr>
        <th bgcolor="#3399ff">Operating System</th>
        <th bgcolor="#3399ff">Participation Percentage (native SCR_CHNG)</th>
      </tr>
</thead>

<tbody>


      
<?php while($row_native_percentage_SCR_CHNG = $result_native_percentage_SCR_CHNG->fetch_assoc()){ ?>
		<tr>
        <th><?php echo $row_native_percentage_SCR_CHNG['os_version']; ?></th>
        <th><?php echo ($row_native_percentage_SCR_CHNG['count_specific_os']/$row_native_percentage_SCR_CHNG['count_total_os'])*100; ?>%</th>
		</tr>
<?php } ?>

</tbody>
</table>

<h2>Participant percentages by Operating System (Hybrid)</h2>
<!-------------------------------------HYBRID--------------------------------------------->
<table class="table table-bordered">
<thead>
      <tr>
        <th bgcolor="#3399ff">Operating System</th>
        <th bgcolor="#3399ff">Participation Percentage (hybrid GET_JSON)</th>
      </tr>
</thead>

<tbody>


      
<?php while($row_hybrid_percentage_GET_JSON = $result_hybrid_percentage_GET_JSON->fetch_assoc()){ ?>
		<tr>
        <th><?php echo $row_hybrid_percentage_GET_JSON['os_version']; ?></th>
        <th><?php echo ($row_hybrid_percentage_GET_JSON['count_specific_os']/$row_hybrid_percentage_GET_JSON['count_total_os'])*100; ?>%</th>
		</tr>
<?php } ?>

</tbody>
</table>

<table class="table table-bordered">
<thead>
      <tr>
        <th bgcolor="#3399ff">Operating System</th>
        <th bgcolor="#3399ff">Participation Percentage (hybrid POST_JSON)</th>
      </tr>
</thead>

<tbody>


      
<?php while($row_hybrid_percentage_POST_JSON = $result_hybrid_percentage_POST_JSON->fetch_assoc()){ ?>
		<tr>
        <th><?php echo $row_hybrid_percentage_POST_JSON['os_version']; ?></th>
        <th><?php echo ($row_hybrid_percentage_POST_JSON['count_specific_os']/$row_hybrid_percentage_POST_JSON['count_total_os'])*100; ?>%</th>
		</tr>
<?php } ?>

</tbody>
</table>

<table class="table table-bordered">
<thead>
      <tr>
        <th bgcolor="#3399ff">Operating System</th>
        <th bgcolor="#3399ff">Participation Percentage (hybrid GMAP_INIT)</th>
      </tr>
</thead>

<tbody>


      
<?php while($row_hybrid_percentage_GMAP_INIT = $result_hybrid_percentage_GMAP_INIT->fetch_assoc()){ ?>
		<tr>
        <th><?php echo $row_hybrid_percentage_GMAP_INIT['os_version']; ?></th>
        <th><?php echo ($row_hybrid_percentage_GMAP_INIT['count_specific_os']/$row_hybrid_percentage_GMAP_INIT['count_total_os'])*100; ?>%</th>
		</tr>
<?php } ?>

</tbody>
</table>

<table class="table table-bordered">
<thead>
      <tr>
        <th bgcolor="#3399ff">Operating System</th>
        <th bgcolor="#3399ff">Participation Percentage(hybrid LEAFMAP_INIT)</th>
      </tr>
</thead>

<tbody>


      
<?php while($row_hybrid_percentage_LEAFMAP_INIT = $result_hybrid_percentage_LEAFMAP_INIT->fetch_assoc()){ ?>
		<tr>
        <th><?php echo $row_hybrid_percentage_LEAFMAP_INIT['os_version']; ?></th>
        <th><?php echo ($row_hybrid_percentage_LEAFMAP_INIT['count_specific_os']/$row_hybrid_percentage_LEAFMAP_INIT['count_total_os'])*100; ?>%</th>
		</tr>
<?php } ?>

</tbody>
</table>

<table class="table table-bordered">
<thead>
      <tr>
        <th bgcolor="#3399ff">Operating System</th>
        <th bgcolor="#3399ff">Participation Percentage(hybrid SCR_CHNG)</th>
      </tr>
</thead>

<tbody>


      
<?php while($row_hybrid_percentage_SCR_CHNG = $result_hybrid_percentage_SCR_CHNG->fetch_assoc()){ ?>
		<tr>
        <th><?php echo $row_hybrid_percentage_SCR_CHNG['os_version']; ?></th>
        <th><?php echo ($row_hybrid_percentage_SCR_CHNG['count_specific_os']/$row_hybrid_percentage_SCR_CHNG['count_total_os'])*100; ?>%</th>
		</tr>
<?php } ?>

</tbody>
</table>

<h2>Execution results (detailed)</h2>
<table class="table table-bordered">
<thead>
      <tr>
        <th bgcolor="#3399ff">Native task</th>
        <th bgcolor="#3399ff">Native execution time</th>
      </tr>
</thead>

<tbody>


      
<?php while($row_native = $result_native->fetch_assoc()){ ?>
		<tr>
        <th><?php echo $row_native['task']; ?></th>
        <th><?php echo $row_native['execution']; ?></th>
		</tr>
<?php } ?>

</tbody>
</table>

<table class="table table-bordered">
<thead>
      <tr>
        <th bgcolor="#3399ff">Hybrid task</th>
        <th bgcolor="#3399ff">Hybrid execution time</th>
      </tr>
</thead>

<tbody>


      
<?php while($row_hybrid = $result_hybrid->fetch_assoc()){ ?>
		<tr>
        <th><?php echo $row_hybrid['task']; ?></th>
        <th><?php echo $row_hybrid['execution']; ?></th>
		</tr>
<?php } ?>

</tbody>
</table>


</body>

<html>