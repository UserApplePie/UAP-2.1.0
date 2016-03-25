<?php

use Helpers\Hooks;

$hooks = Hooks::get();

?>

<h1><?php echo $data['title']; ?></h1>
<table class="table table-striped table-hover table-bordered responsive">
    <thead>
        <tr>
            <th>Username</th>
            <th>First Name</th>
            <th>User Group</th>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach($data['members'] as $member){
            echo "<tr>
                    <td><a href='".DIR."profile/{$member->username}'> {$member->username}</a></td>
                    <td>{$member->firstName}</td>
                    <td class='color {$member->groupFontColor}'>{$member->groupName}</td></tr>";
        }
    ?>
    </tbody>
</table>


<?php
$hooks->run('sidebar');
?>