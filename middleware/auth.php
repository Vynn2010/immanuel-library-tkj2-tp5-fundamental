<?php
const LOGIN_URL = "/pages/auth/login.php";
const BOOK_INDEX_URL = "/pages/books/index.php";
const FORBIDDEN_URL = "/pages/errors/403.php";

//Mengecek apakah sebuah session sudah dimulai / belum, jika belum maka session akan dimulai
function sessionStart()
{
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
}

//Mengecek apakah user sudah login / belum?
function isLoggedIn()
{
    sessionStart();
    $isLoggedIn = isset($_SESSION['user']);

    return $isLoggedIn;
}

//Mendapatkan data user yang sudah login
function getAuthUser()
{
    sessionStart();
    $user = $_SESSION['user'] ?? null;

    return $user;
}

//Mengecek apakah role pengguna sesuai atau tidak
function hasRole(array $roles)
{
    $user = getAuthUser();
    $isUserHasAuthorizeRole = $user != null && in_array($user['role'], $roles);

    return $isUserHasAuthorizeRole;
}

//Menghandle user yang belum login
function requireAuth()
{
    if(!isLoggedIn()){
        $_SESSION['errors'] = [
            'login' => 'Silahkan login terlebih dahulu sebelum mengakses halaman ini'
        ];

        header('Location: ' . LOGIN_URL);
        exit;
    }
}

//Menghandle user yang tidak memiliki role yang sesuai / tidak terautorisasi
function requireRole(array $roles)
{
    requireAuth();

    if (!hasRole($roles)){
        header('Location: ' . FORBIDDEN_URL);
        exit;
    }
}

//Menghandle user yang sudah login sebelumnya
function requireGuest()
{
    if(isLoggedIn()){
        header('Location: ' . BOOK_INDEX_URL);
        exit;
    }
}
?>