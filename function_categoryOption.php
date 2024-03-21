<?php
function categoryOption(){
    include('config.php');
    $sql_category="SELECT * FROM m_category_ticket WHERE status ='enabled' ORDER BY sort_order ASC";
    $query_category = mysqli_query($conn, $sql_category);
    while($fetch_category = mysqli_fetch_assoc($query_category)){
        echo "<option value='".$fetch_category['category_ticket_id']."'>".$fetch_category['name']."</option>";
    }
}
?>