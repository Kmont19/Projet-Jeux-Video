<?php
require_once ('/DB/Model/ModelJeux.php');
$modelJeux = new );
echo json_encode($modelJeux->addJeu($_POST['id_jeu'],
                                    $_POST['nom'],
                                    $_POST['developpeur'],
                                    $_POST['editeur'],
                                    $_POST['rating'],
                                    $_POST['prix'],
                                    $_POST['rabais'],
                                    $_POST['date_de_sortie'],
                                    $_POST['image_lien']));