<?php

    session_start();

    if(!isset($_SESSION["user"]) || $_SESSION["user"]["rol"] !== "admin") {
		header('Location: ./../index.php');
		exit;
	}

    if (isset($_GET["id"])) {

        foreach ($_SESSION["preguntes"] as $key => $pregunta) {

            if ($pregunta["id"] == $_GET["id"]) {
                unset($_SESSION["preguntes"][$key]);
                break;
            }

        }

    }

    header('Location: ./../admin.php');
    exit;