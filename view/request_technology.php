<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="container cards" style="display: none;" id="request_technology" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <a class="col-2 order-3 to_close" onclick="show_('#request_technology')">X</a>
                <h6 class="col-7 order-2">Request Technology Inclusion</h6>
                <a href="#" class="col-3 order-1"></a>
            </div>
            <div class="row">
                <label for="technology" class="col-12 card-field">Technology:</label>
                <input type="text" name="technology" id="technology" class="col-12 card-field" minlength="1" required>
            </div>
            <div class="row">
                <input type="submit" name="request_technology" class="col-12 nav_button" value="Request">
            </div>
        </div>
    </div>
</form>