<?php
include 'Classes/DB.php'; // pliz tell me how da autoloader works

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
        $sql = "SELECT `a`.`id`, `u`.`first_name`, `u`.`last_name`, `a`.`created_at`, `j`.`job_title`,`j`.`job_desc`
                FROM `agenda` a
                LEFT JOIN `job` j ON `a`.`job_id` = `j`.`job_id`
                LEFT JOIN `user` u ON `a`.`user_id` = `u`.`user_id`
                WHERE WEEK(`a`.`created_at`, 3) = ?
                ORDER BY `a`.`created_at` ASC";

        $stmt= $conn->prepare($sql);
        $stmt->execute([$week]);



        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll();

            foreach ($result as $row) {
                $id = $row["id"];
                $first_name = $row["first_name"];
                $last_name = $row["last_name"];
                // $date = date("l j F", strtotime($row["created_at"]));
                $date = strftime("%A %e %B", strtotime($row["created_at"]));
                $job = $row["job_title"];
                $description = $row["job_desc"];


                $html .= <<<HTML
                <div class="calendar-item">
                    <div class="item-head">
                        <div class="item-name">$first_name $last_name</div>
                        <div class="item-date">$date</div>
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
