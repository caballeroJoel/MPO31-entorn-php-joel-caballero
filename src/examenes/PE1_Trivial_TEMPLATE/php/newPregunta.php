<?php

    session_start();

    if (!isset($_SESSION["user"]) || $_SESSION["user"]["rol"] !== "admin") {
        header('Location: ../index.php');
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id = $_POST["id"];

        $preguntaNova = [
            "id" => $id,
            "categoria" => $_POST["categoria"],
            "pregunta" => $_POST["pregunta"],
            "opcions" => [
                $_POST["opcio_0"],
                $_POST["opcio_1"],
                $_POST["opcio_2"],
                $_POST["opcio_3"]
            ],

            "correcta" => $_POST["correcta"]
        ];

        if ($id != 0) {

            foreach ($_SESSION["preguntes"] as $key => $pregunta) {

                if ($pregunta["id"] == $id) {
                    $_SESSION["preguntes"][$key] = $preguntaNova;
                }

            }

        } else {

            $id = 1;

            foreach ($_SESSION["preguntes"] as $pregunta) {
                if ($pregunta["id"] >= $id) {
                    $id = $pregunta["id"] + 1;
                }
            }

            $preguntaNova["id"] = $id;

            array_push($_SESSION["preguntes"], $preguntaNova);

        }

        header('Location: ./../admin.php');
        exit;
    }

    header('Location: ./../admin.php');
    exit;

