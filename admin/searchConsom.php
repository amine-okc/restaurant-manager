<?php
include("dbconn.php");

$q = $_GET['q'];
mysqli_select_db($conn, "restaurant");

function str_contains(string $str, string $substr)
{   
    for($i = 0 ; $i < strlen($str) ; $i++)
    {
        if(substr($str, $i, strlen($substr) - 1) == $substr)
            return TRUE;
    }
    return FALSE;
}

/*if(str_contains($q, ' ') == TRUE){
    $keys = explode(" ", $q);
    $res = [];
    for ($i = 0 ; $i < count($keys) ; $i++){
        $key = $keys[$i];
        if($i == 0)
            $sql = "SELECT * FROM consommations where nom like '%$key%' or prix like '$key%' or type like '$key%'";
        else 
            $sql = $sql . "and numCons in ( SELECT numCons FROM consommations where nom like '%$key%' or prix like '$key%' or type like '$key%')";
    }
}
else{*/
    $sql = "SELECT * FROM consommations where nom like '%$q%' or prix like '$q%' or type like '$q%'";

//}
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($res)) {
?>
    <div class="col-md-auto animate__animated animate__fadeIn">
        <div class="card shadow-lg bg-white rounded" style="width: 18rem; margin : 20px; border-radius : 20px!important">
            <img class="card-img-top" style="border-top-left-radius : 20px;border-top-right-radius : 20px" src="../photos/cons/<?php echo $row['photo'] ?>" width="300" height="200" alt="<?php echo $row['nom'] ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['nom']?></h5>
                <p class="card-text"></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Prix : </b> <?php echo $row['prix'] . ' DA' ?></li>
                <li class="list-group-item"><b>Type : </b> <?php echo ucfirst($row['type']) ?></li>
            </ul>
            <div class="card-body">
                <a href="#" onclick="deleteClasses()" class="card-link update float-start" data-toggle="modal" data-target="#UpdateModalCenter<?php echo $row['numCons'] ?>"><i class="fas fa-edit"></i>&nbsp;Modifier</a>
                <a href="#" onclick="deleteClasses()" class="card-link delete float-end" data-toggle="modal" data-target="#DeleteModalCenter<?php echo $row['numCons'] ?>"><i class="fas fa-trash"></i>&nbsp;Supprimer</a>
            </div>


            <!-- Update Modal -->
            <div class="modal fade" id="UpdateModalCenter<?php echo $row['numCons'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><?php echo "Modifier " . $row['nom'] ?></h5>
                            <button onclick="addClasses()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="name">Nom</label>
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['nom'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="price">Prix</label>
                                    <div class="input-group mb-3">

                                        <input type="number" class="form-control" name="price" value="<?php echo $row['prix'] ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">D.A</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="type">Type</label>
                                    <select class="form-select" name="type">
                                        <option value="entrée" <?php if ($row['type'] == "entrée") echo "selected" ?>>Entrée</option>
                                        <option value="plat" <?php if ($row['type'] == "plat") echo "selected" ?>>Plat</option>
                                        <option value="dessert" <?php if ($row['type'] == "dessert") echo "selected" ?>>Dessert</option>
                                        <option value="boisson" <?php if ($row['type'] == "boisson") echo "selected" ?>>Boisson</option>
                                    </select>
                                    <input name="idCons" hidden value="<?php echo $row['numCons'] ?>">

                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="customFile">Choisir une photo</label>
                                    <input name="image" type="file" class="form-control" />
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
                                    <button type="submit" name="update" class="btn btn-warning">Enregister</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="DeleteModalCenter<?php echo $row['numCons'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><?php echo "Supprimer " . $row['nom'] ?></h5>
                            <button type="button" onclick="addClasses()" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post">
                            <div class="modal-body">

                                <p style="color : black">Voulez-vous vraiment supprimer '<?php echo $row['nom'] ?>' ?</p>
                                <input hidden name="cons" value="<?php echo $row['numCons'] ?>">

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
                                    <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php }  ?>

