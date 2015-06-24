<?php
include '../templates/partials/header.php';
include '../templates/partials/menu.php';

?>

<div class="container-fluid">
	<div class="row">
		<?php include '../templates/partials/sidenav.php'; ?>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h2 class="sub-header">Incident wijzigen - <small>Incident #<?=$data['id']?></small></h2>
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
                        <td>Geplaatst door:</td>
                        <td><?php echo $data['username'];?></td>
                    </tr>
					<tr>
						<td>Datum afgerond:</td>
						<td><input type="datetime" name="datum" value="<?php echo $data['datum'];?>"/></td>
					</tr>
					<tr>
						<td>Omschrijving:</td>
						<td><textarea name="omschrijving" cols="30" rows="5"><?php echo $data['omschrijving'];?></textarea></td>
					</tr>
					<tr>
						<td>Workaround:</td>
						<td><input type="text" name="workaround" value="<?php echo $data['workaround'];?>"/></td>
					</tr>
					<tr>
						<td>Prioriteit:</td>
						<td>
							<select name="prioriteit_id">
                                <?php
                                foreach ($prioriteiten as $prioriteit){
                                    echo "<option ";
                                    if ($prioriteit['id'] == $data['prioriteit_id']){echo " selected ";}
                                    echo "value=\"".$prioriteit['id']."\">".$prioriteit['naam']."</option>";
                                }
                                ?>
							</select>
						</td>
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
						<td>Status:</td>
						<td>
							<select name="status">

								<?php
								foreach ($status as $status_id){
									echo "<option ";
									if ($status_id['id'] == $data['status']){echo " selected ";}
									echo "value=\"".$status_id['id']."\">".$status_id['naam']."</option>";
								}
								?>
							</select>

                            <button form="f_close" class="btn btn-success">Opgelost</button>
						</td>
					</tr>
					<tr>
						<td>Toegewezen aan:</td>
						<td>
							<select name="assigned_to">

								<?php
								foreach ($users as $user){
									echo "<option ";
									if ($user['id'] == $data['assigned_to']){echo " selected ";}
									echo "value=\"".$user['id']."\">".$user['username']."</option>";
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
                        <td>Vergelijkbare Incidenten:</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-toggle="collapse"
                                    data-target="#incidentCollapse" aria-expanded="false" aria-controls="incidentCollapse"
                            <?php if(empty($comparison)){ echo 'disabled';}?>> Toon </button>


                            <div class="collapse" id="incidentCollapse">
                                <br/>
                                <div class="well">
                                    <table class="table table-responsive">
                                        <tr class="panel-head">
                                            <th>Id</th>
                                            <th>Omschrijving</th>
                                            <th>Workaround</th>
                                            <th>Hardware Id</th>
                                            <th>Software</th>
                                            <th></th>

                                        </tr>
                                        <?php foreach($comparison as $item){ ?>

                                            <tr class="panel">
                                                <td><?= $item['id']; ?></td>
                                                <td><?= $item['omschrijving'];?></td>
                                                <td><?= $item['workaround'];?></td>
                                                <td><?= $item['hardware_id'];?></td>
                                                <td><?= $item['uitgebreide_naam']?></td>
                                                <td><a href="<?= $item['id'] ;?>" class="btn btn-default">Bekijk</a></td>

                                            </tr>



                                        <?php } ?>

                                    </table>
                                </div>

                            </div>
                        </td>
                    </tr>
					<tr>
						<td><a href="/incidents/all"><button class="btn btn-default" type="button" form="f_update">Terug</button></a></td>
						<td><button class="btn btn-default" type="submit" form="f_update">Opslaan</button>  </td>
					</tr>


				</table>
			</form>
            <form action="/incidents/close" method="post" id="f_close">
                <input type="hidden" name="id" value="<?php echo $data['id'];?>"/>
            </form>







		</div><!-- end col 8 -->

		<?php include '../templates/partials/footer.php'; ?>
