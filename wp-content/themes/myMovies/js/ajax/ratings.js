jQuery(document).ready(function($) {
    $('.rating-stars').raty({
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
                    alert('Result: '+response.result+'\nUser-ID: '+response.user_id+'\nMovie-ID: '+response.movie_id+'\nRating: '+response.rating);
                }
            });
        }
    });
});