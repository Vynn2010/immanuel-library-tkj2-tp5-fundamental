<?php
require_once __DIR__ . "/../repositories/book-repository.php";
require_once __DIR__ . "/../repositories/category-repository.php";
require_once __DIR__ . "/../repositories/author-repository.php";
function getBookRequest($request)
{

    return [
        'id' => trim(htmlspecialchars($_POST['id'])),
        'title' => trim(htmlspecialchars($_POST['title'])),
        'isbn' =>trim(htmlspecialchars($_POST['isbn'])),
        'year' => trim(htmlspecialchars($_POST['year'])),
        'stock' => trim(htmlspecialchars($_POST['stock'])),
        'description' => trim(htmlspecialchars($_POST['description'])),
        'category_id' => trim(htmlspecialchars($_POST['category_id'])),
        'author_ids' => $_POST['author_ids'] ?? [],
    ];
}

function validateBook($request, $ignoreBookId = 0)
{
    $errors = [];

    if ($request['title']=== ''){
        $errors['title'] = "Judul buku wajib diisi";
    }    elseif (mb_strlen($request['title'])>100) {
        $errors['title'] = "Judul buku tidak boleh melebihi 100 karakter";

    }


    if($request['isbn'] == ''){
        $errors['isbn'] = "ISBN wajib diisi";
    } elseif(isIsbnTaken($request['isbn'] , $ignoreBookId)){
        $errors['isbn'] = "ISBN sudah terdaftar sebelumnya";
    }

    if($request['year'] == '') {
        $errors['year'] = "Tahun terbit wajib diisi";
    } elseif (!is_int(intval($request['year']))){
        $errors['year'] = "Tahun terbit wajib diisi dengan angka";
    }

     if($request['stock'] == '') {
        $errors['stock'] = "Stock wajib diisi";
    } elseif (!is_int(intval($request['year']))){
        $errors['stock'] = "Stock wajib diisi dengan angka";
    }

     if($request['category_id']==''){
        $errors['category_id'] = "Kategori wajib dipilih";
     } elseif(!isCategoryExists($request['category_id'])){
        $errors['category_id'] = "Kategori yang dipilih tidak";
     }

     if(trim($request['description']) == ''){
        $errors['description'] = "Deskripsi wajib diisi";
     } elseif (mb_strlen($request['description']) > 100){
        $errors['description'] = "Deskripsi tidak boleh lebih dari 100 karakter";
     }

     if(count($request['author_ids']) < 1) {
        $errors['author_ids'] = "Penulis buku wajib dipilih";
     } else{
        $authors = getAuthors();
        $validAuthorIds = array_column($authors, 'id');

        foreach($request['author_ids'] as $authorId){
            if(!in_array($authorId, $validAuthorIds)){
                $errors['author_ids'] = "Penulis buku yang dipilih tidak valid";
            }
        }
     }
    return $errors;
}
?>