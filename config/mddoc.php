<?php

return [

    /**
     * Set page title.
     */
    "title" => "Documentation",

    /**
     * Set index page content.
     */
    "index_content" => "README.md",

    /**
     * Set automatically registered router
     */
    "auto_regist_route" => TRUE,

    /**
     * Set router.
     */
    "middlewares" => [],

    "route_path" => "/documentation/{path?}",

    /**
     * Set md files path.
     */
    "markdown_files_path" => "/documentation",

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
