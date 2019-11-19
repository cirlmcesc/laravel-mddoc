function parseUrlPathToId() {
    var patharr = window.location.pathname.split('/').filter(function (item, index) {
        return item !== "" && item !== "documentation";
    });

    var pathstring = "#f-" + patharr[0];

    if (patharr.length > 2) {
        pathstring = pathstring + "-s-" + patharr[1]
    }

    return pathstring
}

function scrollToUl() {
    try {
        t = $(parseUrlPathToId()).offset().top;

        $(".left-menu").scrollTop(t);
    } catch ($e) {
        return false;
    }
}

function parseMarkdownContent() {
    $("main.markdown-content table").addClass("table table-bordered table-hover");
    $("main.markdown-content table thead tr").addClass("bg-primary text-light");
    $("main.markdown-content pre").addClass("m-3 p-3 bg-light border");
    $("main.markdown-content p").addClass("mt-4");
    $("main.markdown-content pre code").toArray().forEach(function (code) {
        var prettystring = syntaxHighlight($(code).text());

        $(code).text("");
        $(code).html(prettystring);
        $(code).children(".string").addClass("text-success");
        $(code).children(".number").addClass("text-warning");
        $(code).children(".boolean").addClass("text-primary");
        $(code).children(".null").addClass("text-info");
        $(code).children(".key").addClass("text-danger");
    });
}

function syntaxHighlight(json) {
    if (typeof json != 'string') {
        json = JSON.stringify(json, undefined, 2);
    }

    json = json.replace(/&/g, '&').replace(/</g, '<').replace(/>/g, '>');

    return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function(match) {
        var cls = 'number';

        if (/^"|^'/.test(match)) {
            if (/:$/.test(match)) {
                cls = 'key';
            } else {
                cls = 'string';
            }
        } else if (/true|false/.test(match)) {
            cls = 'boolean';
        } else if (/null/.test(match)) {
            cls = 'null';
        }

        return '<span class="' + cls + '">' + match + '</span>';
    });
}

$(document).ready(function() {
    parseMarkdownContent();

    scrollToUl();

    $(".link-href").on('click', function () {
        location.href = $(this).data("docurl");
    });

    $(".link-collapse").on('click', function () {
        var sp = $(this).children("div").children(".folding-symbol");

        $(sp).text($(sp).text() === "+" ? "-" : "+");
    });
});
