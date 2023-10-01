<div class="col-1">
    <button onclick="previous_()">
        < </button>
</div>
<div class="col-10 calendar">
    Year-Month: <?php echo date("Y-m", strtotime($_SESSION["date"])); ?>
</div>
<div class="col-1">
    <button onclick="next_()">></button>
</div>
<div class="col-12">
    <div class="row calendar">

        <?php
        $result = $conn->prepare("SELECT distinct(branches.name) as tech, today.id as id,day(today.day) as day FROM today join user_branch on user_branch.id = today.user_branch join branches on branches.id = user_branch.branch join users on users.id = user_branch.user where user_branch.user = {$_SESSION["user"]["id"]} and MONTH(today.day) = " . date("m", strtotime($_SESSION["date"])) . " and month(today.day) >= month(users.created_at) order by branches.name;");
        $result->execute();

        $days = array();

        foreach ($result->fetchAll() as $row) {
            $days[$row["id"]] = array($row["day"] => $row["tech"]);
        }

        $dates = cal_days_in_month(CAL_GREGORIAN, date("m", strtotime($_SESSION["date"])), date("Y", strtotime($_SESSION["date"])));
        for ($d = 1; $d <= $dates; $d++) {
            $check = "";
            $title = "";
            foreach ($days as $a => $b) {
                if (isset($b[strval($d)])) {
                    $check = "green";
                    foreach ($b as $c => $e) {
                        $title .= $e . " ";
                    }
                }
            }
            echo '<div class="col-1 ' . $check . '" title="' . $title . '">' . $d . '</div>';

            $check = "";
            $title = "";
        }
        ?>
    </div>
</div>