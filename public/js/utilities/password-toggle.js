$(document).ready(function () {
        let passwordField = $("#password");
        let showPassword = $("#password-toggle");
        let isShowingPassword = false;

        showPassword.mousedown(function () {
                if (!isShowingPassword) {
                        passwordField.attr("type", "text");
                        showPassword.find("i").removeClass("icon-eye").addClass("icon-eye-slash");
                        isShowingPassword = true;
                }
        });

        showPassword.mouseup(function () {
                if (isShowingPassword) {
                        passwordField.attr("type", "password");
                        showPassword.find("i").removeClass("icon-eye-slash").addClass("icon-eye");
                        isShowingPassword = false;
                }
        });

        showPassword.mouseout(function () {
                passwordField.attr("type", "password");
                showPassword.find("i").removeClass("icon-eye-slash").addClass("icon-eye");
        });
});
