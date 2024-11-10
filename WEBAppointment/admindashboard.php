<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <style>
    body {
        background-color: #F1E6D3; 
        font-family: Arial, sans-serif;
    }

    .container {
        padding: 20px;
    }

    .myheader {
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ccc;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left; 
    }

    th {
        background-color: #800000; 
        color: #fff;
    }

    .btn-update {
        background-color: #28a745; 
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-delete {
        background-color: #dc3545; 
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    a {
        display: block;
        margin-top: 20px;
        text-align: center;
        color: #800000; 
        text-decoration: none;
    }

    .nav-bar {
        background-color: #800000; 
        overflow: hidden;
        padding: 10px 0;
    }

    .nav-bar a {
        float: left;
        display: block;
        color: #fff;
        text-align: center;
        padding: 14px 20px;
        text-decoration: none;
    }

    .nav-bar a:hover {
        background-color: #9c2a2a; 
        color: white;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .tab {
        display: none;
    }

    .tab.active {
        display: block;
    }

    .tab-buttons {
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
    }

    .tab-buttons button {
        background-color: #800000; 
        border: none;
        color: white;
        padding: 10px 20px;
        cursor: pointer;
    }

    .tab-buttons button.active {
        background-color: #9c2a2a; 
    }

</style>

    <script>
        function openTab(appointment, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tab-button");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            appointment.currentTarget.className += " active";
        }
    </script>
</head>
<body>
    <div class="nav-bar">
        <a href="index.html">Logout</a>
    </div>
    <div class="container">
        <div class="myheader">
            <h1>Admin Dashboard</h1>
        </div>
        <br>

        <div class="tab-buttons">
            <button class="tab-button active" onclick="openTab(appointment, 'PendingAppointment')">Pending Appointment</button>
            <button class="tab-button" onclick="openTab(appointment, 'AcceptedAppointment')">Accepted Appointment</button>
            <button class="tab-button" onclick="openTab(appointment, 'DeclinedAppointment')">Declined Appointment</button>
        </div>

        <div id="Pending Appointment" class="tab active">
            <div class="table-responsive">
                <?php
                    $db = mysqli_connect("localhost: 3307", "root", "", "appointment");

                    if (!$db) {
                        die("Connection failed: ". mysqli_connect_error());
                    }

                    $result = mysqli_query($db, "SELECT * FROM tblappointment");

                    echo "<table>";
                    echo "<tr>
                            <th>Professor</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Purpose</th>
                            <th colspan='2'>Manage</th>
                          </tr>";

                    while ($myrow = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<form action='adminmanage.php' method='post'>";
                        //echo "<td><input type='text' name='name' value='". htmlspecialchars($myrow['name']). "' readonly></td>";
                        echo "<td><input type='text' name='professor' value='". htmlspecialchars($myrow['professor']). "' readonly></td>";
                        echo "<td><input type='date' name='date' value='". htmlspecialchars($myrow['date']). "' readonly></td>";
                        echo "<td><input type='time' name='time' value='". htmlspecialchars($myrow['time']). "' readonly></td>";
                        echo "<td><input type='number' name='purpose' value='". htmlspecialchars($myrow['purpose']). "' readonly></td>";
                        echo "<td><center><input type='submit' name='accept' value='ACCEPT' class='btn-update'></center></td>";
                        echo "<td><center><input type='submit' name='decline' value='DECLINE' class='btn-delete'></center></td>";
                        echo "</form>";
                        echo "</tr>";
                    }

                    mysqli_close($db);
                ?>
                </table>
            </div>
        </div>

        <div id="AcceptedReservations" class="tab">
            <div class="table-responsive">
                <table border="1">
                        <tr>
                            <th>Professor</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Purpose</th>
                        </tr>

                    <?php
                        $db = mysqli_connect("localhost: 3307", "root", "", "appointment");

                        if (!$db) {
                            die("Connection failed: ". mysqli_connect_error());
                        }

                        $resultAcc = mysqli_query($db, "SELECT * FROM tblappointment WHERE status = 'accepted'");

                        while ($rowAcc = mysqli_fetch_array($resultAcc)) {
                            echo "<tr>";
                            //echo "<td>". $rowDec['clientname']. "</td>";
                            echo "<td>". $rowDec['professor']. "</td>";
                            echo "<td>". $rowDec['date']. "</td>";
                            echo "<td>". $rowDec['time']. "</td>";
                            echo "<td>". $rowDec['purpose']. "</td>";
                            echo "</tr>";
                        }

                        mysqli_close($db);
                    ?>
                </table>
            </div>
        </div>

        <div id="DeclinedAppointment" class="tab">
            <div class="table-responsive">
                <table border="1">
                        <tr>
                            <th>Professor</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Purpose</th>
                        </tr>

                    <?php
                        $db = mysqli_connect("localhost: 3307", "root", "", "appointment");

                        if (!$db) {
                            die("Connection failed: ". mysqli_connect_error());
                        }

                        $resultDec = mysqli_query($db, "SELECT * FROM tblappointment WHERE status = 'declined'");

                        while ($rowDec = mysqli_fetch_array($resultDec)) {
                            echo "<tr>";
                            //echo "<td>". $rowDec['clientname']. "</td>";
                            echo "<td>". $rowDec['professor']. "</td>";
                            echo "<td>". $rowDec['date']. "</td>";
                            echo "<td>". $rowDec['time']. "</td>";
                            echo "<td>". $rowDec['purpose']. "</td>";
                            echo "</tr>";
                        }

                        mysqli_close($db);
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
