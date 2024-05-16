$('form').submit(function () {
  $(this).find('input[type="submit"], button[type="submit"]').prop('disabled', 'true');
});

$('.cart .del_btn').on('click', function(event) {
    event.preventDefault();
    $('html').addClass('fullOverlay');
    $('select[name=quantity]').attr('disabled', true);
    $.ajax({
        url: "/cart/remove",
        type: 'post',
        data: {
            'id': $(this).data('id')
        },
        timeout: 10000,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(result, textStatus, xhr) {
            window.location.href = "/cart";
        },
        error: function(data) {
            $('.del_btn').attr('disabled', false);
            alert('エラーが発生しました。');
            window.location.href = "/cart";
        }
    });
});
$('.cart .quantity').on('change', function(event) {
    event.preventDefault();
    $('html').addClass('fullOverlay');
    $('.quantity').attr('disabled', true);
    $.ajax({
        url: "/cart/quantity",
        type: 'post',
        data: {
            'id': $(this).data('id'),
            'quantity': $(this).val(),
        },
        timeout: 10000,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(result, textStatus, xhr) {
            window.location.href = "/cart";
        },
        error: function(data) {
            $('.del_btn').attr('disabled', false);
            alert('エラーが発生しました。');
            window.location.href = "/cart";
        }
    });
});
