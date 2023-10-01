<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="container cards" style="display: none;" id="new_technology" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <a class="col-2 order-3 to_close" onclick="show_('#new_technology')">X</a>
                <h6 class="col-7 order-2">I am learning...</h6>
                <a href="#" class="col-3 order-1"></a>
            </div>
            <div class="row">
                <label for="technology" class="col-12 card-field">Technology:</label>
                <select name="technology" class="col-12 card-field" required>
                    <?php
                        $result = $conn->prepare("SELECT * FROM branches where id not in (select branch from user_branch where user_branch.user = {$_SESSION["user"]["id"]}) order by branches.name");
                        $result->execute();

                        foreach($result->fetchAll() as $row)
                        {
                            echo '
                            <option value="' . $row["name"] . '">' . $row["name"] . '</option>
                            ';
                        }
                    ?>
                </select>
            </div>
            <div class="row">
                <label for="started" class="col-12 card-field">Started:</label>
                <input type="date" name="started" id="started" required>
            </div>
            <div class="row">
                <label for="goal" class="col-12 card-field">Goal:</label>
                <textarea name="goal" id="goal" cols="30" rows="3" class="col-12 card-field"></textarea>
            </div>
            <div class="row">
                <input type="submit" name="new_technology" class="col-12 nav_button" value="Add">
            </div>
        </div>
    </div>
</form>