<?php
global $wpdb;
$table = $wpdb->prefix . "secondary_buyers";
$data = $wpdb->get_row("select * from $table where id=" . $_GET['id']);

