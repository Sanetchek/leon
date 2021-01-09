'use strict';

jQuery(document).ready(function ($) {
    $(function ajaxComments() {
        $('.comment-form').each(function () {
            // Объявляем переменные (форма и кнопка отправки)
            var form = $(this),
                btn = form.find('.submit');

            // Добавляем каждому проверяемому полю, указание что поле пустое
            form.find('.required').addClass('empty_field');

            // Функция проверки полей формы
            function checkInput() {
                form.find('.required').each(function () {
                    if ($(this).val() != '') {
                        // Если поле не пустое удаляем класс-указание
                        $(this).removeClass('empty_field');
                    } else {
                        // Если поле пустое добавляем класс-указание
                        $(this).addClass('empty_field');
                    }
                });
            }

            // Функция подсветки незаполненных полей
            function lightEmpty() {
                form.find('.empty_field').css({
                    'border-color': '#d8512d'
                });
                // Через полсекунды удаляем подсветку
                setTimeout(function () {
                    form.find('.empty_field').removeAttr('style');
                }, 500);
            }

            // Проверка в режиме реального времени
            setInterval(function () {
                // Запускаем функцию проверки полей на заполненность
                checkInput();
                // Считаем к-во незаполненных полей
                var sizeEmpty = form.find('.empty_field').size();
                // Вешаем условие-тригер на кнопку отправки формы
                if (sizeEmpty > 0) {
                    if (btn.hasClass('disabled')) {
                        return false
                    } else {
                        btn.addClass('disabled')
                    }
                } else {
                    btn.removeClass('disabled')
                }
            }, 500);

            // Событие клика по кнопке отправить
            btn.click(function () {
                if ($(this).hasClass('disabled')) {
                    // подсвечиваем незаполненные поля и форму не отправляем, если есть незаполненные поля
                    lightEmpty();
                    return false;
                }
            });
        });

        $('body').on('submit', '.comment-form', function (e) {
            // Stop the default form behavior
            e.preventDefault();
            var target = $(e.target),
                targetParent = target.parents('.comment_form'),
                commentform = $(this),
                action = commentform.attr('action'),
                inputs = commentform.serializeArray(),
                submitting_comment = target.find('.submitting-comment'),
                respond = $('#respond');


            // Submitting comment
            $.ajax({ 
                url: action,
                type: 'post',
                data: inputs,

                beforeSend: function () {
                    // Display the loading state
                    commentform.find('p').slideUp();
                    submitting_comment.show();
                },
                success: function (responseText) {
                    reset();

                    function reset() {
                        var temp = $('#wp-temp-form-div');

                        if ($('*').is(temp)) { //если #wp-temp-form-div существует, он добавляется при использовании comment-reply.php
                            commentReplace('.children'); // заменяем комментарии n-го уровня
                        } else {
                            commentReplace('.commentlist'); // заменяем все комментарии
                        }
                    }

                    function commentReplace(changeList) {
                        //Switch the existing comment area with the comment area returned from AJAX call
                        var page = $(responseText); // присваиваем Текст ответа сервера переменной

                        switch (changeList) {
                            case '.children':
                                var commParentRespond = respond.parent(), // ищем родителя #respond
                                    commParentResponseText = page.find('#' + respond.closest('li').attr('id')), // ищем родителя #respond в Тексте ответа от сервера
                                    childrenResponseText = commParentResponseText.find('.children'); // ищем .children в Тексте ответа от сервера Тексте ответа от сервера

                                if (commParentRespond.find(changeList).length) { // если кол-во .children больше 0
                                    commParentRespond.find(changeList).replaceWith(childrenResponseText); // заменяем наш .children тем что мы нашли в Тексте ответа от сервера с тегом .children
                                } else { // если 0
                                    commParentRespond.append(childrenResponseText); // добавляем к родителю #respond тег .children и все содержимое
                                }
                                break;
                            case '.commentlist':
                                var comments = page.find('.commentlist');
                                targetParent.find(changeList).replaceWith(comments); // заменяем наш .commentlist, тем что нашли в Тексте ответа от сервера
                                break;
                            default:
                                console.log('default');
                        }

                    }

                    commentform.find('p').slideDown();
                    submitting_comment.hide();

                },
                error: function (xhr, textStatus, errorThrown) {
                    // Translates the error code status into understandable error message
                    if (textStatus == 'error') {
                        var error_code = xhr.status;
                        if (error_code == 409) {
                            commentform.prepend('<div id="comment-status" >Duplicate comment detected; it looks as though you have already said that!</div>');
                        }
                        if (error_code == 429) {
                            commentform.prepend('<div id="comment-status" style="font-size: 12px;" >You are posting comments too quickly. Slow down.</div>');
                        }
                    }
                }                
            });
        })

    });
});
