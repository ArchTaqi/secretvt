(function($){
    $(document).ready(function() {
        $(".ckeditor").each( function(index){
            var get_id = $(this).attr("id");

            if( !get_id || $(this).prop("nodeName") != 'TEXTAREA' ) return true;

            ClassicEditor
                .create( document.querySelector( '#'+get_id ), {
                    // toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                    alignment: {
                       options: [ 'left', 'center', 'right' ]
                   },
                    language:'ko',
                    toolbar: {
                            items: [
                                'heading',
                                '|',
                                'bold',
                                'italic',
                                'link',
                                'bulletedList',
                                'numberedList',
                                'imageUpload',
                                'blockQuote',
                                'insertTable',
                                'mediaEmbed',
                                'alignment',
                                'undo',
                                'redo'
                                
                            ]
                    },
                    ckfinder: {
                      uploadUrl: cb_url + '/editorfileupload/ckeditor'
                    }
                     
                } )
                    .then( editor => {
            window.editor = editor;
        } )
                .catch( error => {
                    console.log( error );
                
                } );
        });
    });
})(jQuery);