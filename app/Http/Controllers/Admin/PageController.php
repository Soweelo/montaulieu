<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
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
        $pages = Page::where('draft', 0)->orderByDesc('id')->get();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = Page::draft();
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        $data = $request->only('title', 'content');
        if ($page->slug == '') {
            $data['slug'] = '';
        }
        $data['draft'] = 0;
        $page->update($data);
        return redirect()->route('pages.index')->with('success', "La page a bien été enregistrée");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index')->with('success', "La page a bien été supprimée");
    }

    public function activate(Page $page) {
        $data = array('published' => 1);
        $page->update($data);
        return redirect()->route('pages.index')->with('success', "La page a bien été publiée");
    }

    public function deactivate(Page $page) {
        $data = array('published' => 0);
        $page->update($data);
        return redirect()->route('pages.index')->with('success', "La page a bien été dépubliée");
    }
}
