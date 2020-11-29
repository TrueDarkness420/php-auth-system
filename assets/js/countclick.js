document.getElementById('addright').on('click', function () {
        var $qty = $('.form-control .input-number');
        var currentVal = parseInt($qty.val(), 10);
        if (!isNaN(currentVal)) {
            $qty.val(currentVal + 1);
        }
    });
document.getElementById('addleft').on('click', function () {
        var $qty = $('.form-control .input-number');
        var currentVal = parseInt($qty.val(), 10);
        if (!isNaN(currentVal) && currentVal > 1) {
            $qty.val(currentVal - 1);
        }
    });