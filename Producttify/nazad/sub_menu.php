<?php
    add_submenu_page(
    'Dashboard',
    'Material Stock report',
    'Stock Report',
    'manage_options',
    'Material report',
    function () {
                include dirname(__FILE__) . '/sub.php';
            }
    );
    add_submenu_page(
        'Stock Report',
        'Showers',
        'Custom page',
        'manage_options',
        'Show_report',
        function () {
            include dirname(__FILE__) . '/report.php';
        }
    );
?>