<?php

public function uploadPicture(){
    $name = $_POST["nomImage"];
    $img = $_FILES["image"]["nomImage"];

    move_uploaded_file($_FILES["image"]["tmp_name"], "picture/$img");
};

?>