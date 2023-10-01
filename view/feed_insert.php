<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="container cards" style="display: none;" id="add_feed" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <label for="title">Title: </label>
                    <input type="text" name="title" id="title" minlength="1" maxlength="64" class="col-12" required>
                </div>
                <div class="col-12">
                    <label for="title">Content: </label>
                    <textarea name="content" id="content" minlength="1" maxlength="255" class="col-12" required>

                    </textarea>
                </div>
                <div class="col-12">
                    <label for="fixed">Fixed? </label>
                    <input type="checkbox" name="fixed" id="fixed">
                </div>
                <div class="col-12">
                    <input type="submit" name="add_feed" class="col-12 nav_button" value="Post">
                </div>
            </div>
        </div>
    </div>
</form>