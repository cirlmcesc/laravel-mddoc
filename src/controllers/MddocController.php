<?php

namespace Cirlmcesc\LaravelMddoc;

use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\View\View;

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
     * @param string $first_menu
     * @param string $second_menu
     * @param string $third_menu
     * @return Illuminate\View\View
     */
    public function view($first_menu = "", $second_menu = "", $third_menu = "") : View
    {
        $request_url = "/" . ($first_menu == "" ? "" : $first_menu) .
            ($second_menu == "" ? "" : "/" . $second_menu) .
            ($third_menu == "" ? "" : "/" . $third_menu);

        return view("laravelmddoc::mddoc", [
            "title" => config('mddoc.title'),
            "current_file" => $this->mddoc->getCurrentFileName($request_url),
            "first_menu" => $first_menu,
            "second_menu" => $second_menu,
            "third_menu" => $third_menu,
            "directory" => $this->mddoc->buildDirectoryTree(),
            "documentation" => $this->mddoc->readMarkdownContent($request_url),
        ]);
    }
}
