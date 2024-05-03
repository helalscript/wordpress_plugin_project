<?php
$id = $_GET['id'];
global $wpdb;
$r_table = $wpdb->prefix . "raw_materials";
$data=$wpdb->get_row("select * from $r_table where id=$id");
//header('Content-Type: application/json');
echo json_encode($data);
