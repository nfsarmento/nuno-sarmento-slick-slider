(function() {

    tinymce.create('tinymce.plugins.code', {

        init : function(ed, url) {

            ed.addButton('codebutton', {
                title : 'NS Slider',
                cmd : 'codebutton',
                icon: 'icon dashicons-before dashicons-slides'
            });

            ed.addCommand('codebutton', function() {
                var selected_text = ed.selection.getContent();
                var return_text = '';
                return_text = '[slick_slider_tend]';
                ed.execCommand('mceInsertContent', 0, return_text);
            });
        },
    });

    tinymce.PluginManager.add( 'nuno_sarmento_nsss_codebutton', tinymce.plugins.code );

})();
