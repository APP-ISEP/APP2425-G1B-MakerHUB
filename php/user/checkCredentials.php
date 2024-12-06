<?php

function test_input($data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validateEmail($email): bool
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function validateTelephone($telephone): bool
{
    if (preg_match('#^0[0-9]{9}$#', $telephone)) {
        return true;
    } else {
        return false;
    }
}

function hashPassword($motDePasse): string
{
    $hashedPassword = password_hash($motDePasse, PASSWORD_DEFAULT);
    return $hashedPassword;
}

function validatePassword($motDePasse): bool
{
    if (preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,255}$/', $motDePasse)) {
        return true;
    } else {
        return false;
    }
}