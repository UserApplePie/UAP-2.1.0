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
<div class="row">
    <form class="form" method="post">
        <div class="col-xs-12">
            <div class="form-group">
                <label class="control-label">New Email</label>
                <input  class="form-control" type="email" id="newEmail" name="newEmail" placeholder="New Email">
            </div>
            <input type="hidden" name="csrf_token" value="<?= $data['csrf_token']; ?>" />
            <button class="btn btn-primary" type="submit" name="submit">I hate my old email</button>
        </div>

    </form>
</div>
