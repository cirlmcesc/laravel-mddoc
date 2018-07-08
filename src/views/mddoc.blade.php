<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('/lararvelmddoc/assets/css') }}"/>
</head>
<body>
    <!-- 标题栏 -->
    <header class="navbar navbar-expand navbar-dark bg-dark sticky-top shadow">
        <a class="navbar-brand text-monospace ml-3" href="#">
            <h3>{{ $title }}</h3>
        </a>
    </header>
    <!-- 主体 -->
    <div class="container-fluid">
        <div class="row flex-xl-nowrap">
            <!-- 目录树 -->
            <div class="col-md-2 fixed-top left-menu border-right">
                <ul class="list-group list-group-flush">
                    @foreach ($directory as $f => $first)
                        @if (! has_subdir($first))
                            <li class="list-group-item list-group-item-action link-href"
                                data-docurl={{ doc_url($first['url']) }}>
                                <div class="row justify-content-between">
                                    <span class="text-monospace col-sm-11 text-truncate {{ font_bold($first_menu, $first['url']) }}">{{ $f }}</span>
                                </div>
                            </li>
                        @endif
                    @endforeach

                    @foreach ($directory as $f => $first)
                        @if (has_subdir($first))
                            <li class="list-group-item list-group-item-action link-collapse"
                                data-toggle="collapse" href={{ "#". collapse_id('f', $first['url']) }}>
                                <div class="row justify-content-between">
                                    <span class="text-monospace col-sm-9 text-truncate {{ font_bold($first_menu, $first['url']) }}">{{ $f }}</span>
                                    <span class="text-monospace col-sm-1 font-weight-bold folding-symbol">{{ folding_symbol($first_menu, $first['url']) }}</span>
                                </div>
                            </li>
                            <ul class="list-group collapse-list mt-2 ml-4 {{ show_collapse($first_menu, $first['url']) }}" id={{ collapse_id('f', $first['url']) }}>
                                @foreach ($first['children_directory'] as $s => $second)
                                    @if (! has_subdir($second))
                                        <li class="list-group-item border-0 list-group-item-action text-truncate link-href"
                                            data-docurl={{ doc_url($first['url'], $second['url']) }}>
                                            <div class="row justify-content-between">
                                                <span class="text-monospace col-sm-11 text-truncate {{ font_bold($second_menu, $second['url']) }}">{{ $s }}</span>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach

                                @foreach ($first['children_directory'] as $s => $second)
                                    @if (has_subdir($second))
                                        <li class="list-group-item border-0 list-group-item-action link-collapse"
                                            data-toggle="collapse" href={{ "#" . collapse_id('f', $first['url'], 's', $second['url']) }}>
                                            <div class="row justify-content-between">
                                                <span class="text-monospace col-sm-10 text-truncate {{ font_bold($second_menu, $second['url']) }}">{{ $s }}</span>
                                                <span class="text-monospace col-sm-1 font-weight-bold folding-symbol">{{ folding_symbol($second_menu, $second['url']) }}</span>
                                            </div>
                                        </li>
                                        <ul class="list-group collapse-list mt-2 ml-4 list-group-flush {{ show_collapse($second_menu, $second['url']) }}" id={{ collapse_id('f', $first['url'], 's', $second['url']) }}>
                                            @foreach ($second['children_directory'] as $t => $third)
                                                <li class="list-group-item list-group-item-action border-0 text-truncate link-href"
                                                    data-docurl={{ doc_url($first['url'], $second['url'], $third['url']) }}>
                                                    <div class="row justify-content-between">
                                                        <span class="text-monospace col-sm-11 text-truncate {{ font_bold($third_menu, $third['url']) }}">{{ $t }}</span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                </ul>
            </div>
            <!-- 内容 -->
            <div class="row col-md-10 offset-md-2 pr-0 mr-0 right-content">
                <!-- 面包屑 -->
                <div class="row col-md-12">
                    <nav aria-label="breadcrumb" class="content-breadcrumb">
                        <ol class="breadcrumb shadow-sm text-monospace">
                            <li class="breadcrumb-item" {{ $first_menu !== "" ? '' : 'aria-current="page"' }}>
                                @if ($first_menu === "")
                                    Home
                                @else
                                    <a class="text-muted" href="{{ doc_url() }}">Home</a>
                                @endif
                            </li>
                            @if ($first_menu !== "")
                                <li class="breadcrumb-item" {{ $second_menu !== "" ? '' : 'aria-current="page"' }}>
                                    @if ($second_menu === "")
                                        {{ title_case($first_menu) }}
                                    @else
                                        <a class="text-muted" href="#">{{ title_case($first_menu) }}</a>
                                    @endif
                                </li>
                            @endif
                            @if ($second_menu !== "")
                                <li class="breadcrumb-item" {{ $third_menu !== "" ? '' : 'aria-current="page"' }}>
                                    @if ($third_menu === "")
                                        {{ title_case($second_menu) }}
                                    @else
                                        <a class="text-muted" href="#">{{ title_case($second_menu) }}</a>
                                    @endif
                                </li>
                            @endif
                            @if ($third_menu !== "")
                                <li class="breadcrumb-item" aria-current="page">{{ title_case($third_menu) }}</li>
                            @endif
                        </ol>
                    </nav>
                </div>
                <!-- markdown内容 -->
                <main class="markdown-content row col-md-12 p-2" role="main">
                    @if ($documentation === "Markdown file can not find.")
                        <div class="container text-monospace">
                            <div class="jumbotron shadow">
                                <h3 class="display-5">Whoops !!! Looks like something went wrong.</h3>
                                <p class="lead my-3">Markdown file can not find.</p>
                                <hr class="my-5">
                                <p class="lead">
                                    <a class="btn btn-primary btn-lg" href="{{ doc_url() }}" role="button">Back to home page</a>
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="container shadow-sm p-5">
                            @if (! empty($current_file))
                                <nav class="navbar navbar-light bg-light mb-5 justify-content-between">
                                    <h4 class="navbar-brand text-monospace pb-0">{{ $current_file }}</h4>
                                </nav>
                            @endif
                            {!! $documentation !!}
                        </div>
                    @endif
                </main>
            </div>
        </div>
    </div>
    <!-- javascript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ url('/lararvelmddoc/assets/js') }}"></script>
</body>
</html>