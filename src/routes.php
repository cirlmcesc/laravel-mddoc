<?php

if (config("mddoc.auto_regist_route")) {
    Route::group([
        "middleware" => config("mddoc.middlewares"),
    ], function () {
        Route::get(config("mddoc.route_path"), "Cirlmcesc\LaravelMddoc\MddocController@view");
    });
}
