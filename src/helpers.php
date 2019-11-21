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

if (! function_exists("buildMenuKey")) {
    /**
     * Build menu key string function.
     *
     * @return String
     */
    function buildMenuKey() : String
    {
        return implode("-", func_get_args());
    }
}
