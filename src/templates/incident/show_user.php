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
                        <td>Status :</td>
                        <td><?php echo $data['statusnaam'];?></td>
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



                </table>
            </form>
            <?php foreach ($berichten as $bericht){ ?>
                <div class="panel panel-default">
                    <div class="panel-heading">Bericht van <strong><?=$bericht['username'];?> </strong>op <?=$bericht['datum']; ?></div>
                    <div class="panel-body">
                        <?= $bericht['beschrijving'] ; ?>
                    </div>
                    <br/>
                </div>
            <?php } ?>






            </form>
            <form action="/incidents/newmessage" method="post" id="newmessage" class="">
                <div class="panel panel-default">
                    <div class="panel-heading">Stuur nieuw bericht:</div>
                    <div class="panel-body">

                        <textarea class="form-control" name="body" id="" cols="30" rows="10" required placeholder="Type hier uw text."></textarea>
                        <input type="submit" class="btn btn-primary" value=" Verstuur ! "/>
                        <input type="hidden" name="id" value="<?=$data['id'];?>"/>
                        <input type="hidden" name="userid" value="<?= $identity['id'];?>"/>


                    </div>

                </div>

            </form>



        </div><!-- end col 8 -->

        <?php include '../templates/partials/footer.php'; ?>
