var priceOptions = {
    digitGroupSeparator: '.',
    decimalCharacter: ',',
    decimalPlaces: 0,
    modifyValueOnWheel: false,
    selectNumberOnly: true,
    decimalCharacterAlternative: '.',
    currencySymbol: 'Rp. ',
    minimumValue: '0',
    maximumValue: '2000000000',
    unformatOnSubmit: true
};

var qtyOptions = {
    digitGroupSeparator: '.',
    decimalCharacter: ',',
    decimalPlaces: 2,
    modifyValueOnWheel: false,
    selectNumberOnly: true,
    decimalCharacterAlternative: '.',
    currencySymbol: '',
    minimumValue: '0',
    maximumValue: '2000000000',
    unformatOnSubmit: true
};

var APP = {
    run: function () {
        this.flash();
        this.prepareSubmit();
        this.bsToggle();
        this.select2();
        this.datepicker();
        this.prepareAjax();
        this.maskPrice();
        this.maskQty();
    },
    flash: function () {
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    },
    prepareSubmit: function () {
        $(document).on('submit', 'form', function () {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $("form").append("<input name='_token' value='" + csrfToken + "' type='hidden'>");
        });
    },
    prepareAjax: function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    },
    bsToggle: function () {
        $('.bs-toggle').bootstrapToggle();
    },
    select2: function () {
        $(".select2").select2({
            placeholder: $(this).data('placeholder'),
            allowClear: true
        });
    },
    datepicker: function () {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    },
    maskPrice: function () {
        if ($('.mask-price').length > 0) {
            $('.mask-price').each(function (i, obj) {
                if (AutoNumeric.getAutoNumericElement(obj) === null) {
                    new AutoNumeric(obj, priceOptions);
                }
            });
        }
    },
    maskQty: function () {
        if ($('.mask-qty').length > 0) {
            $('.mask-qty').each(function (i, obj) {
                if (AutoNumeric.getAutoNumericElement(obj) === null) {
                    new AutoNumeric(obj, qtyOptions);
                }
            });
        }
    },
};

$(function () {
    APP.run();
});
