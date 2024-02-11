$(document).ready(function () {
       
        $.alertBox = function (message, type, options) {
                options = $.extend({}, $.alertBox.defaultOptions, options);
                type = type || options.type;

                var $existingAlerts = $('.alert-box');
                var offsetSum = options.offsetvalor;

                $existingAlerts.each(function () {
                        offsetSum += $(this).outerHeight() + options.spacing;
                });

                var translatedType = languageTexts[locale][type.toLowerCase()];

                var html = $('<div>', {
                        class: 'alert-box alert-' + type + ' ' + (options.customClass || ''),
                        html: options.close ? '<i class="icon-close-box alert-button-close"></i>' : ''
                }).prepend('<div><i class="event-icon"></i><span><span>' + translatedType.charAt(0).toUpperCase() + translatedType.slice(1) + ':</span> ' + message + '</span></div>');

                var $alertBox = html.css({
                        position: options.appendTo === 'body' ? 'fixed' : 'absolute',
                        margin: 0,
                        'z-index': '9999',
                        display: 'none',
                        'min-width': options.minWidth,
                        'max-width': options.maxWidth,
                        [options.offsetfrom]: offsetSum + 'px'
                }).appendTo(options.appendTo);

                $alertBox.find('.event-icon').addClass('icon-' + type);

                switch (options.align) {
                        case 'center':
                                $alertBox.css({
                                        left: '50%',
                                        'margin-left': '-' + ($alertBox.outerWidth() / 2) + 'px'
                                });
                                break;
                        case 'left':
                                $alertBox.css('left', '20px');
                                break;
                        default:
                                $alertBox.css('right', '45px');
                }

                $alertBox.fadeIn ? $alertBox.fadeIn(150) : $alertBox.css({ display: 'block', opacity: 1 });

                const closeAlert = function () {
                        $.alertBox.close($alertBox, options);
                }

                if (options.delay > 0) {
                        setTimeout(closeAlert, options.delay);
                }

                $alertBox.find('[data-dismiss="alert-box"]').removeAttr('data-dismiss').click(closeAlert);
                $alertBox.find('.alert-button-close').click(closeAlert);

                var audioElement = $.alertBox.playSound(type);
                $alertBox.append(audioElement);

                return $alertBox;
        };

        $.alertBox.close = function ($alertBox, options) {
                options = $.extend({}, $.alertBox.defaultOptions, options);

                if ($alertBox.fadeOut) {
                        $alertBox.fadeOut(250, function () {
                                var removedHeight = $alertBox.outerHeight() + options.spacing;

                                $alertBox.remove();

                                $('.alert-box').each(function () {
                                        var currentOffset = parseInt($(this).css(options.offsetfrom), 10);
                                        $(this).css({ [options.offsetfrom]: currentOffset - removedHeight + 'px' });
                                });
                        });
                } else {
                        return $alertBox.remove();
                }
        };

        $.alertBox.defaultOptions = {
                appendTo: 'body',
                overlap: false,
                customClass: false,
                type: 'info',
                offsetfrom: 'bottom',
                offsetvalor: 100,
                align: 'right',
                minWidth: 450,
                maxWidth: 450,
                delay: 5000,
                close: false,
                spacing: 10,
                qtd: 3,
                audio: 'info'
        };

        $.alertBox.playSound = function (audio) {
                return `<audio autoplay="autoplay" style="display:none;"><source src="/audios/${audio}.mp3" /></audio>`;
        };
});
