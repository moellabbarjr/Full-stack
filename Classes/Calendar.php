<?php

class Calendar
{
    public function GetWeek($offset)
    {
        $week = intval(date("W", strtotime("{$offset} week")));
        $year = date("o", strtotime("{$offset} week")); // o haalt het jaar van de week. Y haalt het huidige jaar. We moeten nog bespreken welke we willen.

        return "Week {$week} - {$year}";
    }

    public function GetTasks($offset)
    {
        $html = "";

        $week = intval(date("W", strtotime("{$offset} week")));

        $stmt = null;
        $div_hidden = null;

        if ($_SESSION["role"] == 1) {
            $check = $_SESSION["loggedin"];
            $sql = "SELECT `a`.`id`, `u`.`first_name`, `u`.`last_name`, `a`.`date`, `j`.`job_title`,`j`.`job_desc`, `a`.`startTime`, `a`.`endTime`
            FROM `agenda` a
            LEFT JOIN `job` j ON `a`.`job_id` = `j`.`job_id`
            LEFT JOIN `user` u ON `a`.`user_id` = `u`.`user_id`
            WHERE WEEK(`a`.`date`, 3) = ? AND `u`.`user_id` = ?
            ORDER BY `a`.`date` AND `a`.`startTime` ASC";

            $conn = (new DB)->connect();
            $stmt= $conn->prepare($sql);
            $stmt->execute([$week, $check]);
            $div_hidden = "hidden";
        }
        else if ($_SESSION["role"] == 2 || 3) {
            $check = $_SESSION["loggedin"];
            $sql = "SELECT `a`.`id`, `u`.`first_name`, `u`.`last_name`, `a`.`date`, `j`.`job_title`,`j`.`job_desc`, `a`.`startTime`, `a`.`endTime`
            FROM `agenda` a
            LEFT JOIN `job` j ON `a`.`job_id` = `j`.`job_id`
            LEFT JOIN `user` u ON `a`.`user_id` = `u`.`user_id`
            WHERE WEEK(`a`.`date`, 3) = ? AND a.job_id = ?
            ORDER BY `a`.`date` AND `a`.`startTime` ASC";

            $conn = (new DB)->connect();
            $stmt= $conn->prepare($sql);
            $stmt->execute([$week , $_SESSION["job_role"]]);
        }

        

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll();

            foreach ($result as $row) {
                $id = $row["id"];
                $first_name = $row["first_name"];
                $last_name = $row["last_name"];
                $startTime = $row["startTime"];
                $endTime = $row["endTime"];
                // $date = date("l j F", strtotime($row["date"]));
                $date = strftime("%A %e %B", strtotime($row["date"]));
                $job = $row["job_title"];
                $description = $row["job_title"];


                $html .= <<<HTML

                <form action="" method="POST">
                    <div class="calendar-item">
                        <div class="item-head">
                            <div class="item-name">$first_name $last_name</div>
                            <div class="item-date">$date</div>
                            <div>Van $startTime tot $endTime</div>
                        </div>

                        <div class="item-body">
                            $description
                        </div>
                        <div class="item-foot" >
                            <div>
                                <input value="$id" type="hidden" name="inputid">
                                <button type="submit" name="verwijderen" class="" style="visibility:$div_hidden;">verwijder</button>
                            </div>
                        </div>
                    </div>
                </form>
HTML;
            }
        } else {
            $html = <<<HTML
            <h2 class="item-message">Geen afspraken voor deze week</h2>
HTML;
        }

        return $html;
    }
}
