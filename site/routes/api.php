<?php

use Illuminate\Support\Facades\Route;

Route::get('/questions',function (){
    $items = [];
    for ($i = 1; $i < 11; $i++){
        $items[]=[
            'id' => $i,
            'name' => 'Question '.$i,
            'category' => 'Category 1',
            'category_id' => 1,
            'edit_href' => '/questions/edit/'.$i,
            'delete_href' => '/questions/delete/'.$i,
        ];
    }

    return [
        'items' => $items
    ];
});
