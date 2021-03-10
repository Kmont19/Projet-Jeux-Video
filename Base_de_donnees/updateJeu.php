<?php
require_once ('BD/Models/ModelJeux.php');
$modelJeux = new ModelJeux();
echo json_encode($modelJeux->updateJeu($_POST['id_jeu'],
                                    $_POST['nom'],
                                    $_POST['categorie'],
                                    $_POST['developpeur'],
                                    $_POST['editeur'],
                                    $_POST['prix'],
                                    $_POST['rabais'],
                                    $_POST['date_de_sortie'],
                                    $_FILES['new_image'],
                                    $_POST['old_image']));