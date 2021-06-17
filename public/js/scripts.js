var APP = {
    run: function () {
        this.logout();
    },
    logout: function () {
        $('#logout').on('click', function () {
            $('#logout-form').submit();
        });
    },
};

var INIT = {
    run: function () {
        this.prepareAjax();
    },
    prepareAjax: function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }
};

var CALL = {
    previewImage: function (input, image) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(image).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
};

$(function () {
    INIT.run();
    APP.run();
});
