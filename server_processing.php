<?php
$table = 'tbl_contact';
 
$primaryKey = 'id';
 
$columns = array(
    array( 'db' => 'no', 'dt' => 0 ),
    array( 'db' => 'nama',  'dt' => 1 ),
    array( 'db' => 'email',   'dt' => 2 ),
    array( 'db' => 'subject', 'dt' => 3,),
    array( 'db' => 'action','dt' => 4,),
   
);
 
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'grobmart2',
    'host' => 'localhost'
);
 
require( 'vendor/datatables/ssp.class.php' );
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
?>