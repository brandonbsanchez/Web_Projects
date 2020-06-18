<?php

session_start();
session_unset(); //Deletes all variables in session
session_destroy();

header('Location: ../index.php?logout=successful');