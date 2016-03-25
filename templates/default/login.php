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
            <div class="alert alert-danger" role="alert">
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
                <label class="control-label">Username or Email</label>
                <input  class="form-control" type="text" id="username" name="username" placeholder="Username or email">
            </div>
            <div class="form-group">
                <label class="control-label">Password</label>
                <input class="form-control" type="password" id="password" name="password" placeholder="password">
            </div>
            <div class="form-inline">
                <label class="control-label">Remember Me</label>
                <input class="form-control" type="checkbox" id="rememberMe" name="rememberMe">
            </div>
            <input type="hidden" name="csrf_token" value="<?= $data['csrf_token']; ?>" />
            <button class="btn btn-primary" type="submit" name="submit">Let Me Login</button>
        </div>

    </form>
</div>
