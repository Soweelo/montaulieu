<?php
Route::post('/attachments', [App\Http\Controllers\Admin\AttachmentController::class, 'store'])->name('attachments.store');
Route::post('/files/{type}', [App\Http\Controllers\Admin\ElementController::class, 'getFiles']);

Route::resource('/cockpit/pages', App\Http\Controllers\Admin\PageController::class);
Route::get('/cockpit/pages/{page}/activate', [App\Http\Controllers\Admin\PageController::class, 'activate'])->name('pages.activate');
Route::get('/cockpit/pages/{page}/deactivate', [App\Http\Controllers\Admin\PageController::class, 'deactivate'])->name('pages.deactivate');

Route::resource('/cockpit/posts', App\Http\Controllers\Admin\PostController::class);
Route::get('/cockpit/posts/{post}/activate', [App\Http\Controllers\Admin\PostController::class, 'activate'])->name('posts.activate');
Route::get('/cockpit/posts/{post}/deactivate', [App\Http\Controllers\Admin\PostController::class, 'deactivate'])->name('posts.deactivate');
Route::post('/cockpit/posts/{post}/uploadImage', [App\Http\Controllers\Admin\PostController::class, 'uploadImage'])->name('posts.uploadImage');
Route::post('/cockpit/posts/{post}/uploadVideo', [App\Http\Controllers\Admin\PostController::class, 'uploadVideo'])->name('posts.uploadVideo');

Route::resource('/cockpit/elements', App\Http\Controllers\Admin\ElementController::class);
Route::post('/cockpit/elements/upload', [App\Http\Controllers\Admin\ElementController::class, 'upload']);
