<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PostsController;
use App\Models\Post;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/post/{id}',[PostsController::class,'index']);

// Route::resource('/posts',PostsController::class);

// Route::get('/contact',[PostsController::class,'contact']);
// Route::get('/post/{id}/{name}/{lastname}',[PostsController::class,'showPost']);

// Route::get('/about', function () {
// return "Hi About page";
// });

// Route::get('/contact', function () {
// return "Hi Contact me!";
// });

// Route::get('/post/{id}/{name}', function ($id,$name) {
// return "this is post number ".$id." ".$name;
// });

// Route::get('admin/posts/example',array('as'=>'admin.home', function(){
// $url=route('admin.home');
// return 'This URL is '.$url;
// }));

Route::get('/insert', function () {
    DB::insert(
        'INSERT INTO posts(title,content,is_admin) VALUES (?,?,?)',
        ['PHP with laravel', 'PHP with laravel is amazing!', 1]
    );
});

Route::get('/read', function () {
    $result = DB::select('SELECT * FROM posts WHERE id=?', [1]);
    foreach ($result as $post) {
        return $post->title;
    }
});

Route::get('/update', function () {
    $updated = DB::update('UPDATE posts SET title="updated title" WHERE id=?', [1]);

    return $updated;
});

Route::get('/delete', function () {
    $deleted = DB::delete('DELETE FROM posts WHERE id=?', [1]);
    return $deleted;
});

/*
|--------------------------------------------------------------------------
| Eloquent
|--------------------------------------------------------------------------
|
*/


Route::get('/read2', function () {

    $posts = Post::all();

    foreach ($posts as $post) {
        return $post->title;
    }
});

Route::get('/find2', function () {

    $post = Post::find(2);

        return $post->title;
    
});

Route::get('/findWhere', function () {

    $posts = Post::WHERE('id',2)->orderBy('id','desc')->take(1)->get();

        return $posts;
    
});

Route::get('/findMore', function () {

    // $posts = Post::findOrFail(1);
    //     return $posts;
        $posts = Post::WHERE('users_count','<',50)->firstOrFail();

        return $posts;
    
});

Route::get('/InsertElo', function () {

    $post= new Post;
    $post->title='New ORM/Eloquent title';
    $post->content='Look at this content from eloquent';

    $post->save();
});
Route::get('/UpdateElo', function () {

    $post= Post::find(2);
    $post->title='New ORM/Eloquent title UPDATED';
    $post->content='Look at this content from eloquent UPDATED';

    $post->save();
});

Route::get('/createElo',function ()
{
    Post::create(['title'=>'The create method','content'=>'This is the body of the content']);
});
Route::get('/UpdateElo2', function () {

    $post= Post::where('id',2)->where('is_admin',1)->update(['title'=>'I love my post']);

});
