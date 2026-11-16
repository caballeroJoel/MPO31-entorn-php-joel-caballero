<?php

    session_start();

    unset($_SESSION["player"]);

    header("Location: ./../index.php");
    exit;