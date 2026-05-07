(function ($) {
    $(".item-quantity").on("change", function (e) {
        $.ajax({
            url: "/cart/" + $(this).data("id"),
            method: "put",
            data: {
                quantity: $(this).val(),
                _token: csrf_token,
            },
        });
    });
})(jQuery);

(function ($) {
    $(".remove-item").on("click", function (e) {
        let id = $(this).data("id");
        $.ajax({
            url: "/cart/" + id,
            method: "delete",
            data: {
                _token: csrf_token,
            },
            success: (response) => {
                $(`#${id}`).remove();
            },
        });
    });
})(jQuery);

(function ($) {
    $(".remove-menu-cart-item").on("click", function (e) {
        let id = $(this).data("id");
        $.ajax({
            url: "/cart/" + id,
            method: "delete",
            data: {
                _token: csrf_token,
            },
            success: (response) => {
                $(`#${id}`).remove();
            },
        });
        $(`.cart-item[data-id="${id}"]`).remove();
        $(".total-items").text(function (_, old) {
            return Math.max(0, parseInt(old) - 1);
        });
    });
})(jQuery);
