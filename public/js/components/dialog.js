$(document).ready(function () {

        $.dialogBox = function (tittle, message, type, callback) {
                var dialogContainer = $('<div class="dialog-box-container">');
                var dialogBox = $('<div class="dialog-box">');
                var dialogHead = $('<div class="dialog-box-head">');
                var dialogTittle = $('<div class="dialog-box-title">').text(tittle);
                var dialogClose = $('<i class="icon-close-box dialog-box-close">');
                var dialogBody = $('<div class="dialog-box-body">').text(message);
                var dialogFooter = $('<div class="dialog-box-foot">');

                dialogHead.append(dialogTittle, dialogClose);

                if (type == 'confirm') {
                        var btnYes = $('<button class="dialogboxbtn dialogboxbtn-yes">').text(languageTexts[locale].btnYes);
                        var btnNo = $('<button class="dialogboxbtn dialogboxbtn-no">').text(languageTexts[locale].btnNo);
                        dialogFooter.append(btnYes, btnNo);
                }

                if (type == 'info') {
                        var btnOk = $('<button class="dialogboxbtn dialogboxbtn-ok">').text(languageTexts[locale].btnOk);
                        dialogFooter.append(btnOk);
                }

                dialogBox.append(dialogHead, dialogBody, dialogFooter);
                dialogContainer.append(dialogBox);
                $('body').append(dialogContainer);

                if (type == 'confirm') {
                        btnYes.click(function () {
                                $.dialogBox.close();
                                callback(true);
                        });

                        btnNo.click(function () {
                                $.dialogBox.close();
                                callback(false);
                        });
                }

                if (type == 'info') {
                        btnOk.click(function () {
                                $.dialogBox.close();
                        });
                }

                dialogBox.find('button').addClass('dialog-btn');

                dialogClose.click(function () {
                        callback ? callback(false) : '';
                        $.dialogBox.close();
                });

                $(document).mouseup(function (e) {
                        if (!dialogBox.is(e.target) && dialogBox.has(e.target).length === 0) {
                                dialogBox.css('box-shadow', '0 0 10px #000');
                                setTimeout(function () {
                                        for (let i = 0; i < 5; i++) {
                                                setTimeout(function () {
                                                        if (i % 2 === 0) {
                                                                dialogBox.css('box-shadow', '0 0 5px #000');
                                                        } else {
                                                                dialogBox.css('box-shadow', '0 0 10px #000');
                                                        }
                                                }, i * 100);
                                        }
                                }, 100);
                        }
                });

                var isDragging = false;
                var initialX, initialY;

                dialogHead.on({
                        mousedown: function (e) {
                                isDragging = true;
                                initialX = e.pageX - parseInt(dialogBox.css('left'));
                                initialY = e.pageY - parseInt(dialogBox.css('top'));
                        }
                });

                $(document).on({
                        mousemove: function (e) {
                                if (isDragging) {

                                        var left = dialogBox.outerWidth() / 2;
                                        var top = dialogBox.outerHeight() / 2;

                                        var newLeft = Math.max(left, Math.min(e.pageX - initialX, $(window).width() - dialogBox.outerWidth() + left));
                                        var newTop = Math.max(top, Math.min(e.pageY - initialY, $(window).height() - dialogBox.outerHeight() + top));

                                        dialogBox.css({ top: newTop + 'px', left: newLeft + 'px' });
                                }
                        },
                        mouseup: function () {
                                isDragging = false;
                        }
                });
        };

        $.dialogBox.close = function () {
                $('.dialog-box-container').remove();
        }
});
