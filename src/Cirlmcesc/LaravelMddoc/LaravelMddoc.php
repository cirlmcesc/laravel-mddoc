<?php

namespace Cirlmcesc\LaravelMddoc;

use ErrorException;
use Parsedown;


class LaravelMddoc
{
    /**
     * Default markdown files path variable.
     *
     * @var String
     */
    public $current_files_path;

    /**
     * Default assets files path variable.
     *
     * @var String
     */
    public $assets;

    /**
     * Parsedown class variable.
     *
     * @var Parsedown
     */
    public $parsedown;

    /**
     * Scan folder not read file variable
     *
     * @var array
     */
    private $donot_read = [
        '.svn', '.git', '.', '..', '.DS_Store'
    ];

    /**
     * Construct function.
     */
    public function __construct()
    {
        $this->current_files_path = base_path() . config("mddoc.markdown_files_path");

        $this->parsedown = new Parsedown();

        $this->assets = [
            'js' => [
                __DIR__ . "/../../views/assets/js/mddoc.js",
            ],
            'css' => [
                __DIR__ . "/../../views/assets/css/mddoc.css",
            ],
        ];
    }

    /**
     * BuildDirectoryTree function.
     *
     * @return Array
     */
    public function buildDirectoryTree() : Array
    {
        return $this->serializeFilesPath($this->current_files_path);
    }

    /**
     * Serialize markdown files path function.
     *
     * @param String $markdown_files_path
     * @return Array
     */
    private function serializeFilesPath(String $markdown_files_path) : Array
    {
        $bash_array = [];

        try {
            foreach (scandir($markdown_files_path) as $filename) {
                $current_fullpath = "{$markdown_files_path}/{$filename}";

                if (! in_array($filename, $this->donot_read) && (
                    ends_with($filename, ".md") || is_dir($current_fullpath)
                )) {
                    $filename = str_replace(".md", "", $filename);

                    $title_filename = $this->dict($filename);

                    $bash_array[$title_filename]["url"] = $filename;

                    if (is_dir($current_fullpath)) {
                        $bash_array[$title_filename]["children_directory"] = $this->serializeFilesPath(
                            $current_fullpath);
                    }
                }
            }
        } catch(ErrorException $error) {
            logger($error);

            return $bash_array;
        }

        return $bash_array;
    }

    /**
     * Read markdown file content function.
     *
     * @param String $request_url
     * @return String
     */
    public function readMarkdownContent(String $request_url) : String
    {
        if ($request_url === "/") {
            $index_content = config("mddoc.index_content");

            if ($index_content !== "README.md") {
                return $index_content;
            }

            $path = base_path() . "/{$index_content}";
        } else {
            $path = "{$this->current_files_path}{$request_url}.md";
        }

        try {
            return $this->parsedown->text(file_get_contents($path));
        } catch (ErrorException $error) {
            return "Markdown file can not find.";
        }
    }

    /**
     * Check config.mddoc.dict has fielname function
     *
     * @return void
     */
    public function dict(String $filename) : String
    {
        $dict = config("mddoc.dict");

        return array_key_exists($filename, $dict) ? $dict[$filename] : title_case($filename);
    }

    /**
     * Generate current file name function.
     *
     * @param String $request_url
     * @return String
     */
    public function getCurrentFileName(String $request_url) : String
    {
        return $this->dict(collect(explode("/", $request_url))->last());
    }

    /**
     * Parse markdown content function.
     *
     * @param String $markdown_content
     * @return String
     */
    public static function parseMarkdownContent(String $markdown_content) : String
    {
        $parsedown = new Parsedown();

        return $parsedown->text($markdown_content);
    }

    /**
     * Dump assets to string function.
     *
     * @param String $type
     * @return String
     */
    public function dumpAssetsToString(String $type) : String
    {
        $content = "";

        foreach ($this->assets[$type] as $file) {
            $content .= file_get_contents($file);
        }

        return $content;
    }
}
