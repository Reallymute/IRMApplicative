$.initEditor = function(selector, fullOptions, contentCss) {
    //Si contentCss non defini -> on recupere les styles de la page courante
    if (typeof contentCss === 'undefined') {
        var time = new Date().getTime();
        var contentCssArray = new Array();
        $('link[rel=stylesheet]').each(function() {
            contentCssArray.push($(this).attr('href') + '?' + time);
        });
    }
    contentCss = contentCssArray.join(',');

    if (fullOptions === true) {
        tinymce.init({
            language: 'fr_FR',
            selector: selector,
            content_css: contentCss,
            plugins: [
                'autolink contextmenu charmap code hr link paste searchreplace textcolor visualblocks'
            ], 
            menu: {
                edit: {
                    title: 'Edit',
                    items: 'undo redo | cut copy paste pastetext | selectall | searchreplace'
                },
                format: {
                    title: 'Format',
                    items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'
                },
                insert: {
                    title: 'Insert',
                    items: 'link | charmap hr'
                },
                view: {
                    title: 'View',
                    items: 'visualblocks visualaid'
                },
                tools: {
                    title: 'Tools',
                    items: 'code'
                }
            },
            toolbar: 'undo redo | styleselect | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | link | charmap hr',
            contextmenu: 'cut copy paste pastetext | link | charmap hr', 
            convert_urls: false,
            relative_urls: false,
            entity_encoding: 'raw',
            height: 500
        });
    } else if (typeof fullOptions === "string") {
        tinymce.init({
            language: 'fr_FR',
            selector: selector,
            content_css: contentCss,
            plugins: [
                'autolink contextmenu charmap code hr link paste searchreplace textcolor visualblocks'
            ], 
            menu: {},
            toolbar: fullOptions, 
            convert_urls: false,
            relative_urls: false,
            entity_encoding: 'raw',
            height: 500
        });
    } else {
        tinymce.init({
            language: 'fr_FR',
            selector: selector,
            content_css: contentCss,
            plugins: [
                'autolink contextmenu charmap code hr link paste searchreplace textcolor visualblocks'
            ], 
            menu: {},
            toolbar: 'bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | link ', 
            convert_urls: false,
            relative_urls: false,
            entity_encoding: 'raw',
            height: 500
        });
    }
};
