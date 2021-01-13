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

        $conn = (new DB)->connect();
        $sql = "SELECT `a`.`id`, `u`.`first_name`, `u`.`last_name`, `a`.`date`, `j`.`job_title`,`j`.`job_desc`, `a`.`startTime`, `a`.`endTime`
                FROM `agenda` a
                LEFT JOIN `job` j ON `a`.`job_id` = `j`.`job_id`
                LEFT JOIN `user` u ON `a`.`user_id` = `u`.`user_id`
                WHERE WEEK(`a`.`date`, 3) = ? AND `u`.`user_id` = ?
                ORDER BY `a`.`date` AND `a`.`startTime` ASC";

        $stmt= $conn->prepare($sql);
        $stmt->execute([$week, $_SESSION["loggedin"]]);



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
                $description = $row["job_desc"];


                $html .= <<<HTML
                <div class="calendar-item">
                    <div class="item-head">
                        <div class="item-name">$first_name $last_name</div>
                        <div class="item-date">$date</div>
                        <div>Van $startTime tot $endTime</div>
                    </div>

                    <div class="item-body">
                        $description
                    </div>

                    <div class="item-foot">
                        <div>
                            <label for="done$id">Gedaan:</label>
                            <input type="checkbox" name="done$id" id="done$id" value="$id">
                        </div>
                    </div>
                </div>
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
