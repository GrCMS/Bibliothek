jQuery(document).ready(function($) {
    var is_user = $('.rating-stars').attr("is-user");
    $('.rating-stars').raty({
        readOnly: is_user,
        halfShow: true,
        starOff: 'movie-off.png',
        starOn: 'movie-full.png',
        starHalf: 'movie-half.png',
        score: function() {
            return $(this).attr('data-score');
        },
        click: function(score, evt) {
            var movie_id = $(this).attr("movie-id");
            $.ajax({
                type: "post",
                dataType: "json",
                url: myAjax.ajaxurl,
                data: {
                    action: "mm_rating", 
                    movie: movie_id,
                    rating: score
                },
                success: function(response) {
                    $('.movie-'+response.movie_id).text(response.global_rating);
                }
            });
        }
    });
});