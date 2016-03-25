<div class="container">
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
        <div class="col-xs-12">
            <h1>Edit Profile <strong><?php echo $data['profile']->username; ?></strong></h1>
            <hr>

            <form role="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="firstName">First Name: </label><span class="label label-danger pull-right">Required</span>
                    <input id="firstName" type="text" class="form-control" name="firstName" placeholder="Enter your Name" value="<?php echo $data['profile']->firstName; ?>">
                </div>
                <div class='form-group'>
                    <label for="gender">Gender: </label><span class="label label-danger pull-right">Required</span>
                    <select class='form-control' id='gender' name='gender'>
                        <option value='male' <?php if($data['profile']->gender == "Male") echo "selected";?> >Male</option>
                        <option value='female' <?php if($data['profile']->gender == "Female") echo "selected";?> >Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="website">Website: </label>
                    <input id="website" type="website" class="form-control" name="website" placeholder="Enter your website" value="<?php echo $data['profile']->website; ?>">
                </div>
                <?php if($data['profile']->userImage != ""){ ?>
                <input id="oldImg" name="oldImg" type="hidden" value="<?php echo $data['profile']->userImage; ?>"">
                <div class="form-group">
                    <label for="email">Current Profile Picture: </label>
                    <img alt="User Pic" src="<?php echo DIR.$data['profile']->userImage; ?>" class="img-circle img-responsive">
                </div>
                <?php } ?>
                <div class="form-group">
                    <label class="control-label">New Profile Picture</label>
                    <input type="file" class="form-control" accept="image/jpeg" id="profilePic" name="profilePic">
                </div>
                <div class="form-group">
                    <label for="aboutMe">About Me: </label>
                    <textarea id="aboutMe"  class="form-control" name="aboutMe" placeholder="Enter Profile" rows="5"><?php echo str_replace('<br />' , '', $data['profile']->aboutme); ?></textarea>
                </div>
                <input type="hidden" name="csrf_token" value="<?= $data['csrf_token']; ?>" />
                <input type="submit" name="submit" class="btn btn-primary" value="Update my profile info!!">
            </form>
        </div>
    </div>
</div>