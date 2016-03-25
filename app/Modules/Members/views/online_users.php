<div class="row">
    <div class='panel panel-default'>
        <div class='panel-heading'>
            <h3>Users Status</h3>
        </div>
        <ul class="list-group">
            <li class="list-group-item"><a href="<?php echo DIR; ?>members">Members: <?php echo $data['activatedAccounts']; ?></a></li>
            <li class="list-group-item"><a href="<?php echo DIR; ?>online-members">Members Online: <?php echo $data['onlineAccounts']; ?></a></li>
        </ul>
    </div>
</div>