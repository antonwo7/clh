<?php

function error ($message)
{
    $error = json_encode(['result' => false, 'message' => $message]);
    echo $error;
    die();
}

function html ($value)
{
    echo "<table cellpadding='7' cellspacing='3' border='1'>";
    foreach ($value as $i => $row) {
        echo "<tr>";
        foreach ($row as $v) {
            echo "<td>";
            echo $v instanceof DateTime ? $v->format('d-m-Y') : $v;
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

function dd ($value)
{
    var_dump($value);
    die();
}