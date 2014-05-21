jQuery(document).ready(function($) {
    $('.rating-stars').raty({
        readOnly: false,
        halfShow: true,
        starOff: 'movie-off.png',
        starOn: 'movie-full.png',
        starHalf: 'movie-half.png',
        width: 150,
        score: function() {
            return $(this).attr('data-score');
        },
        click: function(score, evt) {
            $('input[name="rating"]').val(score);
        }
    });
    $('.rating-show').raty({
        readOnly: true,
        halfShow: true,
        starOff: 'movie-off.png',
        starOn: 'movie-full.png',
        starHalf: 'movie-half.png',
        width: 150,
        score: function() {
            return $(this).attr('data-score');
        }
    });
});