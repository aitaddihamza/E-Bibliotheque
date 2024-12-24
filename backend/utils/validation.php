<?php

// fonctoin pour nettoyage des données comme d'espaces ou de code.
function cleanData($data)
{
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}
