<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\PostRequest;
use App\Models\Media;
use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('draft', 0)->orderByDesc('id')->get();
        foreach ($posts as $post) {
            $post = $this->getMediaForPost($post);
        }
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = Post::draft();
        $post->media = '';
        $post->media_type = '';
        return view('admin.posts.edit', compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post = $this->getMediaForPost($post);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->only('title', 'content', 'excerpt');
        if ($post->slug == '') {
            $data['slug'] = '';
        }
        $data['draft'] = 0;
        $post->update($data);

        return redirect()->route('posts.index')->with('success', "L'article a bien été enregistré");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->deleteMedias();
        $post->delete();
        return redirect()->route('posts.index')->with('success', "L'article a bien été supprimé");
    }

    public function activate(Post $post) {
        $data = array('published' => 1);
        $post->update($data);
        return redirect()->route('pages.index')->with('success', "L'article a bien été publié");
    }

    public function deactivate(Post $post) {
        $data = array('published' => 0);
        $post->update($data);
        return redirect()->route('pages.index')->with('success', "L'article 'a bien été dépublié");
    }

    public function uploadImage(ImageRequest $request, Post $post) {
        // on supprime l'ancien media par défaut
        $post->deleteMedias();

        if ($post->slug != '') {
            $name = "montaulieu-".$post->slug;
        } else {
            $name = "montaulieu-".date('Y-m-d-H-i-s');
        }

        if ($_FILES['image']['type'] == 'image/jpeg') {
            $name .= '.jpg';
        } else {
            $name .= '.png';
        }

        $dir = $post->getImageDir();
        if (!is_dir($dir)) {
            mkdir($dir, 0777);
        }
        $target_file = $dir.'/'.$name;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sizes = getimagesize($target_file);
            $largeur = $sizes[0];
            $tab_image = explode('.', $name);
            $thumb_size = ($largeur > 150) ? 150 : $largeur;
            ImageManagerStatic::make($target_file)->resize($thumb_size, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($dir.'/'.$tab_image[0].'_thumb.'.$tab_image[1]);

            $small_size = ($largeur > 300) ? 300 : $largeur;
            ImageManagerStatic::make($target_file)->resize($small_size, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($dir.'/'.$tab_image[0].'_small.'.$tab_image[1]);

            $medium_size = ($largeur > 600) ? 600 : $largeur;
            ImageManagerStatic::make($target_file)->resize($medium_size, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($dir.'/'.$tab_image[0].'_medium.'.$tab_image[1]);

            $large_size = ($largeur > 900) ? 900 : $largeur;
            ImageManagerStatic::make($target_file)->resize($large_size, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($dir.'/'.$tab_image[0].'_large.'.$tab_image[1]);

            $full_size = ($largeur > 1200) ? 1200 : $largeur;
            ImageManagerStatic::make($target_file)->resize($full_size, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($dir.'/'.$tab_image[0].'_full.'.$tab_image[1]);

            // on supprime l'ancien media par défaut
            $post->deleteMedias();

            // on enregistre le nouveau media dans la table
            $data = array(
                'name'  => $name,
                'type'  => 1,
                'default'   => 1
            );
            $post->saveMedia($data);

            return redirect()->route('admin.posts.edit', $post)->with('success', "L'image a bien été enregistrée");
        }
        return redirect()->route('admin.posts.edit', $post)->with('error', "L'image n'a pas pu être enregistrée");
    }

    public function uploadVideo(ImageRequest $request, Post $post) {
        // on supprime l'ancien media par défaut
        $post->deleteMedias();

        // on enregistre le nouveau media dans la table
        $data = array(
            'name'  => 'video-'.$post->id,
            'type'  => 2,
            'default'   => 1,
            'video'     => $request->video
        );
        $post->saveMedia($data);

        return redirect()->route('admin.posts.edit', $post)->with('success', "La vidéo a bien été enregistrée");

    }

    protected function getMediaForPost($post) {
        $default_media = Media::defaultByIdType($post->id, get_class($post))->first();
        if ($default_media) {
            $post->media_type = $default_media->type;
            if ($default_media->type == 1) {
                $post->media = $default_media->imageByTaille('thumb');
            }
            if ($default_media->type == 2) {
                $post->media = $default_media->video;
            }
        } else {
            $post->media_type = '';
            $post->media = '';
        }
        return $post;
    }
}
