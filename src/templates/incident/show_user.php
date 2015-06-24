<?php
include '../templates/partials/header.php';
include '../templates/partials/menu.php';

?>

<div class="container-fluid">
    <div class="row">
        <?php include '../templates/partials/sidenav.php'; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h2>Incident : <?php echo $data["id"];?></h2>
            <h3>Incident Wijzigen</h3>
            <form action="/incidents/update" method="post" id="f_update">
                <input type="hidden" value="<?php echo $data['id'];?>" name="id"/>
                <input type="hidden" name="user_id" value="<?php echo $data['user_id'];?>"/>
                <input type="hidden" name="categorie_id" value="<?php echo $data['categorie_id'];?>"/>
                <table class="table">
                    <tr>
                        <td>Geplaatst op:</td>
                        <td><?php echo $data['datum'];?></td>
                    </tr>
                    <tr>
                        <td>Omschrijving:</td>
                        <td><textarea name="omschrijving" cols="30" rows="5"><?php echo $data['omschrijving'];?></textarea></td>
                    </tr>
                    <tr>
                        <td>Hardware:</td>
                        <td>
                            <select name="hardware_id">
                                <?php
                                foreach ($hardware as $hardware_id){
                                    echo "<option ";
                                    if ($hardware_id['id'] == $data['hardware_id']){echo " selected ";}
                                    echo "value=\"".$hardware_id['id']."\">".$hardware_id['id']."</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Software:</td>
                        <td>
                            <select name="software_id">
                                <option value="null">Niet van toepassing</option>
                                <?php
                                foreach ($software as $software_id){
                                    echo "<option ";
                                    if ($software_id['id'] == $data['software_id']){echo " selected ";}
                                    echo "value=\"".$software_id['id']."\">".$software_id['uitgebreide_naam']."</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Opmerking:</td>
                        <td><textarea name="opmerking" cols="30" rows="5"><?php echo $data['beschrijving'];?></textarea></td>
                    </tr>
                    <tr>
                        <td><a href="/incidents/all"><button class="btn btn-default" type="button" form="f_update">Terug</button></a></td>
                        <td><button class="btn btn-default" type="submit" form="f_update">Opslaan</button>  </td>
                    </tr>


                </table>
            </form>


        </div><!-- end col 8 -->

        <?php include '../templates/partials/footer.php'; ?>
