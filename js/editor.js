var textarea = document.querySelector('.editor');

if (window.tinyMCE) {
    tinymce.init({
        selector: '.editor',
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        menubar: 'edit insert view format table help',
        toolbar: "undo redo | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview media fullpage | forecolor backcolor",
        paste_data_images: true,
        automatic_uploads: true,
        relative_urls: false, remove_script_host: false, convert_urls: true,
        link_context_toolbar: true,
        file_picker_types: 'file image',
        file_picker_callback:   function(callback, value, meta) {
            var data2 = new FormData();
            var url = "http://site-32.envol4.serveur-dedie.fr/files";
            if (meta.filetype == 'file') {
                url += '/pdf';
            }
            if (meta.filetype == 'image') {
                url += '/image';
            }
            axios.post(url, data2)
                .then(function (res) {
                    $.each(res.data.elements, function(key, value) {
                        if (meta.filetype == 'file') {
                            let chaine = '<div class="col-12 col-lg-3 mt-3 text-center" name="chooseFile" data-type="pdf" style="cursor: pointer" data-ref="' + value.media + '" data-name="' + value.name + '">';
                            chaine += '</a><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">\n' +
                                '                                            <path d="M5.523 12.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548zm2.455-1.647c-.119.025-.237.05-.356.078a21.148 21.148 0 0 0 .5-1.05 12.045 12.045 0 0 0 .51.858c-.217.032-.436.07-.654.114zm2.525.939a3.881 3.881 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256zM8.278 6.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z"/>\n' +
                                '                                            <path fill-rule="evenodd" d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.651 11.651 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.697 19.697 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z"/>\n' +
                                '                                        </svg>';
                            chaine += '<div>' + value.name + '</div>'
                            chaine += '</div>';
                            $('#modal-medias-body').append(chaine);
                        }
                        if (meta.filetype == 'image') {
                            let chaine = '<div class="col-12 col-lg-3 mt-3 text-center" name="chooseFile" data-type="image" style="cursor: pointer" data-ref="' + value.media + '" data-name="' + value.name + '">';
                            chaine += '<img src="http://site-32.envol4.serveur-dedie.fr/' + value.media + '" style="max-width: 100%" />';
                            chaine += '</div>';
                            $('#modal-medias-body').append(chaine);
                        }
                    })
                    $('#modal-medias').modal('show');
                    // success(res.data.url)
                })
                .catch(function (err) {
                    alert(err.response.statusText)
                })

            // $('div[name=chooseFile]').on('click', function(e) {
            $(document).on('click', 'div[name=chooseFile]', function(e) {
                e.preventDefault();
                $('#modal-medias').modal('hide');
                if ($(this).data('type') == 'pdf') {
                    callback('http://site-32.envol4.serveur-dedie.fr/' + $(this).data('ref'), {text: $(this).data('name')});
                }

                // Provide image and alt text for the image dialog
                if ($(this).data('type') == 'image') {
                    callback('http://site-32.envol4.serveur-dedie.fr/' + $(this).data('ref'), {alt: $(this).data('name')});
                }
            })
        },
        images_upload_handler: function (blobinfo, success, failure) {
            var data = new FormData();
            data.append('attachable_id', textarea.dataset.id);
            data.append('attachable_type', textarea.dataset.type);
            data.append('name', blobinfo.blob(), blobinfo.filename());
            axios.post(textarea.dataset.url, data)
                .then(function (res) {
                    console.log(res)
                    success(res.data.url)
                })
                .catch(function (err) {
                    alert(err.response.statusText)
                    success('http://placehold.it/350x150')
                    // failure(err.response.statusText)
                })
        }
    })

}
