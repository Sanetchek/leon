"use strict";

jQuery(document).ready(function ($) {
    /*
     *  MediaUploader functions
     */

    uploadMedia('#upload-button', '#banner-image', '#banner-picture');
    uploadMedia('#upload-favicon-button', '#value-favicon', '#favicon');
    uploadMedia('#upload-header-logo-button', '#value-header-logo', '#header-logo');
    uploadMedia('#upload-footer-logo-button', '#value-footer-logo', '#footer-logo');

    function uploadMedia(idClickButton, idAssignValueInputField, idChangePicture) {
        $(idClickButton).on('click', function (e) {
            var mediaUploader;
            e.preventDefault(); //security command
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }

            mediaUploader = wp.media.frames.file_frame = wp.media({
                multiple: false
            });

            mediaUploader.on('select', function () {
                let attachment = mediaUploader.state().get('selection').first().toJSON();
                $(idAssignValueInputField).val(attachment.url); // Присваиваем значение для поля input
                $(idChangePicture).attr('src', attachment.url); // Меняем изображение в верстке
            });

            mediaUploader.open();
        });
    }


    /*
     * scripts
     */
    // change_input_text($('#banner-input-title'), $('#banner-title'));

    // function change_input_text(inputText, changedContentField) {
    //     inputText.on('input', function () {
    //         var text = $(this).val();
    //         changedContentField.text(text);
    //     });
    // }
});
