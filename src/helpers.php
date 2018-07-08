<?php

if (! function_exists("parse_markdown")) {
    /**
     * Parse markdown content function.
     *
     * @param String $markdown_content
     * @return String
     */
    function parse_markdown(String $markdown_file_path) : String {
        try {
            return \Cirlmcesc\LaravelMddoc\LaravelMddoc::parseMarkdownContent(
                file_get_contents($markdown_file_path));
        } catch(ErrorException $error) {
            logger($error);

            return "Markdown file can not find.";
        }
    }
}

if (! function_exists("has_subdir")) {
    /**
     * Check dir has subdir function.
     *
     * @param Array $dir
     * @return Bool
     */
    function has_subdir(Array $dir) : Bool {
        return array_key_exists('children_directory', $dir);
    }
}

if (! function_exists("doc_url") ){
    /**
     * Generate documentation url function.
     *
     * @return String
     */
    function doc_url() : String {
        return url("/documentation/".implode("/", func_get_args()));
    }
}

if (! function_exists("collapse_id")) {
    /**
     * Generate collapse item id function.
     *
     * @return String
     */
    function collapse_id() : String {
        return implode("-", func_get_args());
    }
}

if (! function_exists("show_collapse")) {
    /**
     * Generate show or collapse string function.
     *
     * @param String $menu
     * @param String $url
     * @return String
     */
    function show_collapse(String $menu, String $url) : String {
        return $menu === $url ? "show" : "collapse";
    }
}

if (! function_exists("font_bold")) {
    /**
     * Generate font bold class string function.
     *
     * @param String $menu
     * @param String $url
     * @return String
     */
    function font_bold(String $menu, String $url) : String {
        return $menu === $url ? "font-weight-bold" : "";
    }
}

if (! function_exists("folding_symbol")) {
    /**
     * Generate folding symbol string function.
     *
     * @param String $menu
     * @param String $url
     * @return String
     */
    function folding_symbol(String $menu, String $url) : String {
        return $menu === $url ? "-" : "+";
    }
}
