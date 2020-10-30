//add fileinput generator to jquery
(function ($) {
    $.fn.mediaInputGen = function (response, cb = () => {}) {
        var footerTemplate =
            '<div class="file-thumbnail-footer">\n' +
            '<div style="margin:5px 0">\n' +
            '<input name="gallery_desc" class="kv-input kv-init form-control input-sm" value="{desc}" placeholder="Ввести описание">\n' +
            '</div>\n' +
            '<span class="file-drag-handle drag-handle-init text-info" title="Перетащить/Пересортировать"><i class="glyphicon glyphicon-move"></i></span>' +
            '{actions}\n' +
            '</div>';
        var actions =
            '<div class="file-actions">\n' +
            '<div class="file-footer-buttons">\n' +
            '{upload}{delete}' +
            '<button type="button" class="btn btn-sm btn-default gallery_upd" data-url="{upd}" title="Сохранить описание">\n' +
            '<i class="glyphicon glyphicon-floppy-disk"></i>\n' +
            '</button>\n' +
            '{zoom}\n' +
            '</div>\n' +
            '<div class="clearfix"></div>\n' +
            '</div>';

        this.fileinput({
            uploadUrl: '/hc-file/upload/',
            uploadAsync: true,

            layoutTemplates: { footer: footerTemplate, actions: actions },
            overwriteInitial: false,
            maxFileCount: 100,

            uploadExtraData: {
                file_target_id: response.file_target_id,
            },

            dropZoneTitle: 'Перетащить файлы сюда',
            ajaxDeleteSettings: { method: 'post' },
            initialPreviewThumbTags: response.initialPreviewThumbTags,
            initialPreview: response.initialPreview,
            initialPreviewConfig: response.initialPreviewConfig,
            previewFileIconSettings: {
                doc: '<i class="fa fa-file-word-o text-primary"></i>',
                xls: '<i class="fa fa-file-excel-o text-success"></i>',
                ppt: '<i class="fa fa-file-powerpoint-o text-danger"></i>',
                zip: '<i class="fa fa-file-archive-o text-muted"></i>',
            },
        })
            .on('filesorted', function (event, params) {
                const newSort = params.stack.map((element, index) => {
                    return { res_id: element.res_id, new_sort: index + 1 };
                });
                console.log(newSort);
                $.ajax({
                    url: '/hc-file/resort/',
                    type: 'post',
                    data: { newSort },
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (response) {
                        console.log(response);
                    },
                });
            })
            .on('filedeleted', function (event, key, jqXHR, data) {
                console.log('Key = ' + key, data);
            });
        cb();
    };
})(jQuery);

$(() => {
    //save fileinput image description
    $('body').on('click', '.gallery_upd', function () {
        var to = $(this).data('url');
        var value = $(this)
            .parents('.file-thumbnail-footer')
            .find('input[name="gallery_desc"]')
            .val();
        $.ajax({
            url: to,
            type: 'post',
            data: {
                text: value,
            },
            success: function (resp) {
                console.log(resp);
            },
            error: function (resp) {
                console.log(resp);
            },
        });
    });

    //insta upload
    $(document).on('filebatchselected', '.file-input', function (event, files) {
        const $input = $(this).find('[type=file]');
        $input.fileinput('upload');
    });

    //render fileInput for each defined container
    const fileInputs = $('input[type=file].file_upload');
    fileInputs.each(function () {
        const $input = $(this);
        const data = {
            file_target_id: $input.data('file_target_id'),
        };
        const gen = ($input) => (response) => {
            $input.mediaInputGen(response);
        };
        $.ajax({
            url: '/hc-file/fast-view/',
            type: 'post',
            dataType: 'json',
            data,
            success: gen($input),
            error: function (response) {
                console.error(response);
            },
        });
    });

    $('[data-last-file]').on('click', function (e) {
        const $btn = $(this);
        const data = {
            file_target_id: $btn.data('attach'),
            file_id: $btn.data('last-file'),
        };
        $.ajax({
            url: '/hc-file/attach/',
            type: 'post',
            dataType: 'json',
            data: data,
            success: (response) => {
                if (response.error == '') {
                    $input = $(
                        `[data-file_target_id="${data.file_target_id}"]`
                    );
                    const data2 = {
                        file_target_id: $input.data('file_target_id'),
                    };
                    const close = ($input) => (response) => {
                        $input.fileinput('destroy');
                        $input.mediaInputGen(response);
                    };
                    $.ajax({
                        url: '/hc-file/fast-view/',
                        type: 'post',
                        dataType: 'json',
                        data: data2,
                        success: close($input),
                        error: function (response) {
                            console.error(response);
                        },
                    });
                }
            },
            error: function (response) {
                console.error(response);
            },
        });
    });
});
