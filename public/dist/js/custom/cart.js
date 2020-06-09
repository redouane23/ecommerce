$(document).ready(function () {

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    //disabled btn
    $('body').on('click', '.disabled', function (e) {

        e.preventDefault();

    });//end of disabled

    //add product btn
    $('.add-product-btn').on('click', function (e) {

        e.preventDefault();
        $(this).removeClass('btn-outline-primary text-primary').addClass('btn-danger disabled');


        var id = $(this).data('id');
        var cart = $(this).data('cart');
        var route = $(this).data('route');

        //alert(route);


        $.ajax({

            type: 'POST',
            data: {product_id: id, cart: cart},
            url: route,


            success: function (data) {

                //alert('ggg');

                $('.cart-count').html(data.cartCount);

                new Noty({
                    type: 'success',
                    layout: 'topRight',
                    text: data.success,
                    timeout: 1500,
                    killer: true
                }).show();

            },
            error: function (data) {

                console.log('Error:', data);

            }

        });

        //alert(id);

    });//end of add product btn

    //update product btn
    $('body').on('click', '.update-product-btn', function (e) {

        e.preventDefault();
        var value = $(this).data('value');
        var id = $(this).data('id');
        var cart = $(this).data('cart');
        var quantity = parseFloat($('#quantity' + id).html().replace(/,/g, ''));


        if (value == "down") {

            if (quantity > 1) {

                quantity -= 1;

            }

        } else {

            quantity += 1;
        }

        //alert(quantity);
        $.ajax({

            type: 'PUT',
            data: {product_id: id, cart: cart, quantity: quantity},
            url: 'carts/update',


            success: function (data) {

                //alert(data.success);
                $('#quantity' + data.id).html($.number(data.quantity, 0));
                $('#total_price' + data.id).html($.number(data.total_price, 0));
                //$('.cart-count').html(data.cartCount);
                $('.total-price').html($.number(data.cart.total_price, 0));

                new Noty({
                    type: 'success',
                    layout: 'topRight',
                    text: data.success,
                    timeout: 1500,
                    killer: true
                }).show();


            },
            error: function (data) {

                console.log('Error:', data);

            }

        });

    });//end of update product btn

    //remove product btn
    $('body').on('click', '.remove-product-btn', function (e) {

        e.preventDefault();
        var id = $(this).data('id');
        var cart = $(this).data('cart');


        $.ajax({

            type: 'DELETE',
            data: {product_id: id, cart: cart},
            url: 'carts/delete',


            success: function (data) {

                //alert(data.success);
                $('#id' + data.id).closest('tr').remove();
                $('.cart-count').html(data.cartCount);
                $('.total-price').html(data.cart.total_price);

                if (data.cartCount == 0) {

                    $('#non-empty').hide();
                    $('#empty').show();

                }

                new Noty({
                    type: 'success',
                    layout: 'topRight',
                    text: data.success,
                    timeout: 1500,
                    killer: true
                }).show();

            },
            error: function (data) {

                console.log('Error:', data);

            }

        });

    });//end of remove product btn

    //confirm cart btn
    $('body').on('click', '.confirm-cart-btn', function (e) {

        e.preventDefault();
        var cart = $(this).data('cart');
        var route = $(this).data('route');


        $.ajax({

            type: 'POST',
            data: {cart: cart},
            url: route,


            success: function (data) {

                swal(data.success, data.title, "success")
                    .then(() => {
                            document.location.href = data.url
                        }
                    );


            },
            error: function (data) {

                console.log('Error:', data);

            }

        });

    });//end of confirm cart btn

});//end of document ready
