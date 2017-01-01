<?php
/**
 * Este fichero es parte de WikiRed
 *
 * @version 0.1
 * @link https://tamainut.com/
 * @autor AbdelKarim Mateos
 * @copyright Copyright (C) 2016 Abdelkarim Mateos. All rights reserved.
 * @license LGPL
 * @license https://opensource.org/licenses/lgpl-license.php "Lesser" General Public License, version 3.0 (LGPL-3.0)
 * @package \\\
 */


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

/* Reescrito abajo
Route::get('posts/{post}', function (Post $post) {
    return view('posts.show', compact('post'));
})->name('posts.show');
*/
Route::get('posts/{post}', [
    'as' => 'posts.show',
    'uses' => 'PostController@show',
])->where('posts', '\d+');  // where para forzar a que sea numerico
//->where('posts', '[0-9]+');


/* Reescrito abajo
Route::get('posts/{post}', function (Post $post) {
    return view('posts.show', compact('post'));
})->name('posts.show');
*/