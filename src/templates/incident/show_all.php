<!-- Shows a list of incident items -->
<?php
include '../templates/partials/header.php';
include '../templates/partials/menu.php';
?>

<h2 class="sub-header">Incidenten</h2>
<div class="table-responsive">
    <table class="table table-striped">

        <!-- Table head -->
        <thead>
        <tr>
            <th>Id</th>
            <th>Datum</th>
            <th>User Id</th>
            <th>Toegewezen</th>
            <th>Omschrijving</th>
            <th>Hardware ID</th>
            <th>Prioriteit</th>
            <th></th>

        </tr>
        </thead>

        <!-- Table body -->
        <tbody>

        <?php

        foreach ($data as $row) {
            ?>
            <form action="/incidents" method="post" id="<?php echo "f_".$row["id"];?>">
                <input type="hidden" name="incident_id" value="<?php echo $row["id"];?>"/>
            </form>
            <tr>
                <td><?php echo $row["id"];?></td>
                <td><?php echo $row["datum"];?></td>
                <td><?php echo $row["user_id"];?></td>
                <td><?php echo $row["assigned_to"];?></td>
                <td><?php echo $row["omschrijving"];?></td>
                <td><?php echo $row["hardware_id"];?></td>
                <td><?php echo $row["prioriteit_id"];?></td>
                <td><button class="btn btn-default" type="submit" form="<?php echo "f_".$row["id"];?>">Change</button></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<?php
include '../templates/partials/footer.php';
