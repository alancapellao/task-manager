$(document).ready(function () {

        $.loadBox = function (mode) {

                if (mode === 1) {
                        var html =
                                `<div class="scene">
				<img src="/images/logo-simple.svg" alt="logo-load">
		  	<h3 class="loading">LOADING</h3>
		  </div>`;

                        $('body').prepend(html);
                        $('.scene').focus();
                } else {
                        $.loadBox.remove('.scene');
                }
        };

        $.loadBox.remove = function (e) {
                $('.loading').animate({
                        "top": $('.scene').height() + "px",
                        "opacity": 0
                }, 100, function () {
                        $(e).remove();
                });

                return $.loadBox.remove;
        };
});
