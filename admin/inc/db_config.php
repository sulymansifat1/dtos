<?php
$hname = 'localhost';
$uname = 'root';
$pass = '';
$db = 'dtos';

$con = mysqli_connect($hname, $uname, $pass, $db);

if (!$con) {
    die("Cannot connect to database: " . mysqli_connect_error());
}

function filteration($data)
{
    foreach ($data as $key => $value) {
        $data[$key] = trim($value);
        $data[$key] = stripslashes($value);
        $data[$key] = htmlspecialchars($value);
        $data[$key] = strip_tags($value);
    }
    return $data;
}

function select($sql, $values, $datatypes)
{
    global $con;
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed -select");
        }
    } else {
        die("Query cannot be prepared - select");
    }
}

function update($sql, $values, $datatypes)
{
    global $con;
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed -update");
        }
    } else {
        die("Query cannot be prepared - update");
    }
}

function delete($sql, $values, $datatypes)
{
    global $con;
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - delete");
        }
    } else {
        die("Query cannot be prepared - delete");
    }
}

function insert($sql, $values, $datatypes)
{
    global $con;
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - insert");
        }
    } else {
        die("Query cannot be prepared - insert");
    }
}