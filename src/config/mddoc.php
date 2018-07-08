<?php

return [

    /**
     * Set page title.
     */
    "title" => "Document",

    /**
     * Set index page content.
     */
    "index_content" => "README.md",

    /**
     * Set automatically registered router
     */
    "auto_regist_route" => TRUE,

    /**
     * Set router path.
     */
    "route_path" => "/document/{first?}/{second?}/{third?}",

    /**
     * Set md files path.
     */
    "markdown_files_path" => "/document",

    /**
     * Set dict
     */
    "dict" => [
        /**
         *  For an example
         *
         * 'instructions' => '项目说明',
         */
    ],

];
