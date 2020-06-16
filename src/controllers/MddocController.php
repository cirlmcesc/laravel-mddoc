<?php

namespace Cirlmcesc\LaravelMddoc;

use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Cirlmcesc\LaravelMddoc\LaravelMddoc;

class MddocController extends Controller
{
    /**
     * LaravelMddoc class variable.
     *
     * @var \Cirlmcesc\LaravelMddoc\LaravelMddoc
     */
    public $mddoc;

    /**
     * Assets cache sec 1 year variable
     *
     * @var integer
     */
    public $assets_cache_sec = 31536000;

    /**
     * Contruct function.
     *
     * @return void
     */
    public function __construct()
    {
        $this->mddoc = new LaravelMddoc();
    }

    /**
     * Show page view function.
     *
     * @return Illuminate\View\View
     */
    public function view(String $path = "/"): View
    {
        return view("laravelmddoc::mddoc", [
            "title" => config('mddoc.title'),
            "directory" => $this->mddoc->buildDirectoryTree(),
            "markdown_content" => $this->mddoc->readMarkdownContent($path),
            "route_path" => str_replace('/{path?}', '', config('mddoc.route_path')),
            "menu_seleced" => $this->mddoc->buildMenuKey($path),
            "selected_key" => $path,
        ]);
    }
}
