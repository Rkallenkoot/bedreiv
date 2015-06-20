<?php
include '../templates/partials/header.php';
include '../templates/partials/menu.php';



?>


    <div class="row">
        <div class="col-md-4"></div>

        <div class="col-md-4">
            <h2>Nieuw incident registreren</h2>
            <form action="/incident_new" method="post" id="f_new">
                <input name="user_id" type="hidden" value="<?php echo $data['identity']['id'];?>"/>
                <table class="table table-responsive">

                    <tr>
                        <td>Omschrijving:</td>
                        <td><textarea name="omschrijving" cols="30" rows="10"></textarea></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Software:</td>
                        <td>
                            <select name="software_id" id="">
                                <option value="null">Niet van toepassing</option>
                                <?php
                                foreach ($software as $software_id){
                                    echo "<option value=\"".$software_id['id']."\">".$software_id['uitgebreide_naam']."</option>";

                                }

                                ?>



                            </select>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Hardware:</td>
                        <td><select name="hardware_id" id="">

                                <?php
                                foreach ($hardware as $hardware_id){
                                    echo "<option value=\"".$hardware_id['id']."\">".$hardware_id['id']."</option>";

                                }

                                ?>



                            </select></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Categorie:</td>
                        <td><select name="categorie_id" id="">

                                <?php
                                foreach ($categorie as $categorie_id){
                                    echo "<option value=\"".$categorie_id['id']."\">".$categorie_id['naam']."</option>";

                                }

                                ?>



                            </select></td>
                        <td></td>
                    </tr>


                </table>
            </form>
            <table class="table table-responsive">
                <tr>
                    <td><a href="/"><button class="btn btn-default">Terug</button></a></td>
                    <td></td>
                    <td><button class="btn btn-success" form="f_new">Registreren</button></td>
                </tr>
            </table>


        </div><!-- end col 8 -->
        <div class="col-md-4">

        </div>
    </div><!--endrow-->


<?php include '../templates/partials/footer.php'; ?>