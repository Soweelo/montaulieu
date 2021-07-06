<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Element;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic;

class ElementController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except(['upload']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images_elements = Element::where('type', 1)->orderByDesc('id')->paginate(100);
        foreach($images_elements as $image_element) {
            $image_element->media = $image_element->getImageDir().'/'.$image_element->imageByTaille('small');
        }
        $pdf_elements = Element::where('type', 2)->orderByDesc('id')->paginate(100);
        foreach ($pdf_elements as $pdf_element) {
            $pdf_element->url = $pdf_element->getImageDir().'/'.$pdf_element->name;
        }
        $other_elements = Element::where('type', 2)->orderByDesc('id')->paginate(100);

        return view('admin.elements.index', compact('images_elements', 'pdf_elements', 'other_elements'));
    }

    public function upload(Request $request) {
        list($first, $extension) = explode('.', $_FILES['file']['name']);
        $type_element = 0;
        if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            $type_element = 1;
        }
        if ($extension == 'pdf') {
            $type_element = 2;
        }
//        if (in_array($extension, ['doc', 'xls', 'xlsx', 'docx'])) {
//            $type_element = 3;
//        }
        if ($type_element == 0) {
            return array('code' => '20');
        }

        if (filesize($_FILES['file']['tmp_name']) > 5000000) {
            // fichier trop volumineux
            return array('code' => '30');
        }

        // on regarde si un élément de même nom n'existe pas déjà
        $old_element = Element::where('name', $_FILES['file']['name'])->first();
        if ($old_element) {
            $name = $first.'-'.date('YmdHis').'.'.$extension;
        } else {
            $name = $_FILES['file']['name'];
        }
        $data = array('name' => $name, 'type' => $type_element);
        $element = Element::create($data);

        $dir = $element->getImageDir();
        if (!is_dir($dir)) {
            mkdir($dir, 0777);
        }

        $target_file = $dir.'/'.$name;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

            if ($type_element == 1) {
                // c'est une image, on la redimmensionne
                $tab_image = explode('.', $name);
                $sizes = getimagesize($target_file);
                $largeur = $sizes[0];
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

                unlink($target_file);
                $return_file = $dir.'/'.$tab_image[0].'_small.'.$tab_image[1];
            } else {
                $return_file = $target_file;
            }

            return array('code' => 0, 'target' => url($return_file), 'type' => $type_element, 'name' => $name);
        } else {
            $element->delete();
            return array('code' => 10);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Element $element)
    {
        if ($element->type == 1) {
            // c'est une image, on supprime tous les fichiers chargés
            $tab_name = explode('.', $element->name);
            $dir = $element->getImageDir().'/';
            $thumb_file = $dir.$tab_name[0].'_thumb.'.$tab_name[1];
            unlink($thumb_file);
            $small_file = $dir.$tab_name[0].'_small.'.$tab_name[1];
            unlink($small_file);
            $medium_file = $dir.$tab_name[0].'_medium.'.$tab_name[1];
            unlink($medium_file);
            $large_file = $dir.$tab_name[0].'_large.'.$tab_name[1];
            unlink($large_file);
            $full_file = $dir.$tab_name[0].'_full.'.$tab_name[1];
            unlink($full_file);
        } else {
            // un seul fichier à supprimer
            $file = $element->getImageDir().'/'.$element->name;
            unlink($file);
        }
        $element->delete();

        return redirect()->route('elements.index')->with('success', 'Le fichier a bien été supprimé');
    }

    public function getFiles($type) {
        // on récupère tous les fichiers et on les renvoie
        $query = Element::orderByDesc('id');
        if ($type == 'pdf') {
            $query->where('type', 2);
        }
        if ($type == 'image') {
            $query->where('type', 1);
        }
        $elements = $query->get();
        foreach ($elements as $element) {
            $dir = $element->getImageDir();
            if ($type == 'image') {
                $element->media = $dir.'/'.$element->imageByTaille('medium');
            } else {
                $element->media = $dir.'/'.$element->name;
            }
        }

        return json_encode(array('elements' => $elements));
    }
}
