<?php

if (config("mddoc.auto_regist_route")) {
    Route::get(config("mddoc.route_path"), "Cirlmcesc\LaravelMddoc\MddocController@view");
}
