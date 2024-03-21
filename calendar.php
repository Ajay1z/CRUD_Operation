<!DOCTYPE html>
<html>
<head>
    <title>Calendar</title>
    <style>
        body {
            background-image: url('Batman.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        table {
            border-collapse: collapse;
            width: 50%;
        }

        th, td {
            border: 1px solid #fff;
            padding: 5px;
            text-align: center;
            font-size: 16px;
        }

        th {
            background-color: #333;
        }

        td {
            background-color: #555;
            color: #fff;
        }

        .pagination {
            margin-top: 70px;
            text-align: center;
        }

        .pagination button {
            padding: 8px 16px;
            margin: 0 5px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }

        .jump-form {
            margin-top: 50px;
            text-align: center;
            font-size: 26px;
        }

        .jump-form label {
            color: #fff;
            margin-right: 10px;
            font-size: 40px;
        }

        .jump-form input[type="number"] {
            width: 60px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #fff;
            background-color: rgba(255, 255, 255, 0.3);
            color: #fff;
            font-size: 20px;
            color:green;
        }

        .jump-form button {
            padding: 8px 16px;
            border: none;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            font-size: 40px;
        }
    </style>
</head>
<body>

<?php
// Function to get and display calendar
function generateCalendar($month, $year) {
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $lastDayOfMonth = mktime(0, 0, 0, $month, date('t', $firstDayOfMonth), $year);
    $numDays = date('t', $firstDayOfMonth);
    $startDay = date('N', $firstDayOfMonth);
    
    $daysOfWeek = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
    
    echo "<h2>" . date('F Y', $firstDayOfMonth) . "</h2>";
    echo "<table>";
    echo "<tr>";
    foreach ($daysOfWeek as $day) {
        echo "<th>$day</th>";
    }
    echo "</tr>";
    
    echo "<tr>";
    
    // Fill in blank cells for days before the first day of the month
    for ($i = 1; $i < $startDay; $i++) {
        echo "<td></td>";
    }
    
    // Display days of the month
    for ($day = 1; $day <= $numDays; $day++) {
        echo "<td>$day</td>";
        
        if (($startDay + $day - 1) % 7 == 0) { // Start a new row for each week
            echo "</tr><tr>";
        }
    }
    
    // Fill in blank cells for days after the last day of the month
    $lastDayWeekday = date('N', $lastDayOfMonth);
    if ($lastDayWeekday < 7) {
        for ($i = $lastDayWeekday; $i < 7; $i++) {
            echo "<td></td>";
        }
    }
    
    echo "</tr>";
    echo "</table>";
}

// Get current month and year
$currentMonth = isset($_GET['month']) ? intval($_GET['month']) : date('n');
$currentYear = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

// Display current month calendar
generateCalendar($currentMonth, $currentYear);
?>

<div class='pagination'>
    <button onclick='previousMonth()'>Previous Month</button>
    <button onclick='nextMonth()'>Next Month</button>
</div>

<div class='jump-form'>
    <form action='' method='get'>
        <label for='jumpMonth'>Month:</label>
        <input type='number' id='jumpMonth' name='month' min='1' max='12' value='<?php echo $currentMonth; ?>'>
        <label for='jumpYear'>Year:</label>
        <input type='number' id='jumpYear' name='year' min='1900' max='2100' value='<?php echo $currentYear; ?>'>
        <button type='submit'>Jump</button>
    </form>
</div>

<script>
    // JavaScript functions for pagination
    function previousMonth() {
        window.location.href = "?month=<?php echo ($currentMonth == 1) ? 12 : ($currentMonth - 1); ?>&year=<?php echo ($currentMonth == 1) ? ($currentYear - 1) : $currentYear; ?>";
    }

    function nextMonth() {
        window.location.href = "?month=<?php echo ($currentMonth == 12) ? 1 : ($currentMonth + 1); ?>&year=<?php echo ($currentMonth == 12) ? ($currentYear + 1) : $currentYear; ?>";
    }
</script>

</body>
</html>
