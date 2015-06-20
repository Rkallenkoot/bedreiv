<!-- Shows a list of incident items -->
<?php
include '../templates/partials/header.php';
include '../templates/partials/menu.php';
?>


<div class="col-md-1"></div>
<div class="col-md-10">
    <h2 class="sub-header">Incidenten</h2>
    <div class="table-responsive">
        <table class="table table-striped">

            <!-- Table head -->
            <thead>
            <tr>
                <th>Id</th>
                <th>Datum</th>
                <th>Datum Afgerond</th>
                <th>Omschrijving</th>
                <th>Workaround</th>
                <th>Prioriteit</th>
                <th>Hardware ID</th>
                <th>Software</th>
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
                    <td><?php echo $row["datum_afgerond"];?></td>
                    <td><?php echo $row["omschrijving"];?></td>
                    <td><?php echo $row['workaround'];?></td>
                    <td><?php echo $row['prioriteit_id'];?></td>
                    <td><?php echo $row["hardware_id"];?></td>
                    <td><?php echo $row["software_id"];?></td>
                    <td><button class="btn btn-default" type="submit" form="<?php echo "f_".$row["id"];?>">Wijzig</button></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-1"></div>
<?php
include '../templates/partials/footer.php';
