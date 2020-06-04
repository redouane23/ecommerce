$(document).ready(function () {

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    //add product btn
    $('.add-product-btn').on('click', function (e) {

        e.preventDefault();
        $(this).removeClass('btn-outline-primary text-primary').addClass('btn-danger disabled');


        var id = $(this).data('id');
        var cart = $(this).data('cart');

        //alert(cart);


        $.ajax({

            type: 'POST',
            data: {product_id: id, cart: cart},
            url: 'carts/add',


            success: function (data) {

                $('.cart-count').html(data.cartCount);

                new Noty({
                    type: 'success',
                    layout: 'topRight',
                    text: data.success,
                    timeout: 1500,
                    killer: true
                }).show();

            }

        });

        //alert(id);

    });

    //disabled btn
    $('body').on('click', '.disabled', function (e) {

        e.preventDefault();

    });//end of disabled

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

                new Noty({
                    type: 'success',
                    layout: 'topRight',
                    text: data.success,
                    timeout: 1500,
                    killer: true
                }).show();

            }

        });

    });//end of remove product btn

    //change product quantity
    $('body').on('keyup change', '.product-quantity', function () {

        var quantity = Number($(this).val()); //2
        var unitPrice = parseFloat($(this).data('price').replace(/,/g, '')); //150
        console.log(unitPrice);
        $(this).closest('tr').find('.product-price').html($.number(quantity * unitPrice, 2));
        calculateTotal();

    });//end of product quantity change

    //list all order products
    $('.order-products').on('click', function (e) {

        e.preventDefault();

        $('#loading').css('display', 'flex');

        var url = $(this).data('url');
        var method = $(this).data('method');
        $.ajax({
            url: url,
            method: method,
            success: function (data) {

                $('#loading').css('display', 'none');
                $('#order-product-list').empty();
                $('#order-product-list').append(data);

            }
        })

    });//end of order products click

    //print order
    $(document).on('click', '.print-btn', function () {

        $('#print-area').printThis();

    });//end of click function

});//end of document ready

//calculate the total
function calculateTotal() {

    var price = 0;

    $('.order-list .product-price').each(function (index) {

        price += parseFloat($(this).html().replace(/,/g, ''));

    });//end of product price

    $('.total-price').html($.number(price, 2));

    //check if price > 0
    if (price > 0) {

        $('#add-order-form-btn').removeClass('disabled')

    } else {

        $('#add-order-form-btn').addClass('disabled')

    }//end of else

}//end of calculate total
