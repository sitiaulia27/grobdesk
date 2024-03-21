<?php
function getTicketList()
{
    include 'config.php';
    $no = 1;
    $get = "SELECT * FROM m_ticket";
    $query = mysqli_query($conn, $get);
    while ($row = mysqli_fetch_assoc($query)) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['subject'] . "</td>";
        echo "<td><a class='btn btn-warning' href='detail_ticket.php?id=" . $row['ticket_id'] . "'><i a class = 'fa fa-info-circle'></i>Detail</a>
        <a class='btn btn-danger' href='delete.php?id=" . $row['ticket_id'] . "'><i class = 'fa fa-trash'></i>Delete</a>";
        echo "</tr>";
    }
}
