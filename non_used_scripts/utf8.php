<?php
mysqli_query($dbc, "SET NAMES UTF8");
mysqli_query($dbc, "SET CHARACTER SET UTF8");
mysqli_query($dbc, "SET collation_connection='utf8_general_ci'");
mysqli_query($dbc, "SET collation_database='utf8_general_ci'");
mysqli_query($dbc, "SET collation_server='utf8_general_ci'");
mysqli_query($dbc, "SET character_set_client='utf8'");
mysqli_query($dbc, "SET character_set_connection='utf8'");
mysqli_query($dbc, "SET character_set_database='utf8'");
mysqli_query($dbc, "SET character_set_results='utf8'");
mysqli_query($dbc, "SET character_set_server='utf8'");
?>