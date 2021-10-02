$(function () {
  $(document).scroll(function () {
    var $nav = $(".navbar-fixed-top");
    $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
  });

  $('.card-post-detail-upvote').mouseover(function () {
    $(this).addClass('bi-arrow-up-circle');
    $(this).removeClass('bi-arrow-up-circle-fill');
  });

  $('.card-post-detail-upvote').mouseleave(function () {
    $(this).removeClass('bi-arrow-up-circle');
    $(this).addClass('bi-arrow-up-circle-fill');
  });

  $('.card-post-detail-downvote').mouseover(function () {
    $(this).addClass('bi-arrow-down-circle');
    $(this).removeClass('bi-arrow-down-circle-fill');
  });

  $('.card-post-detail-downvote').mouseleave(function () {
    $(this).removeClass('bi-arrow-down-circle');
    $(this).addClass('bi-arrow-down-circle-fill');
  });
});