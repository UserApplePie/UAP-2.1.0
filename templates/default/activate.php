<div class="row">
    <div class="col-xs-12">
        <h1><?php echo $data['title']; ?></h1>
    </div>
</div>
<?php
if(isset($data['message'])) {
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-<?php echo $data['type']=="success" ? "success" : "danger"; ?>" role="alert">
                <?php echo isset($data['message']) ? $data['message'] : ""; ?>
            </div>
        </div>
    </div>


    <?php
}
?>