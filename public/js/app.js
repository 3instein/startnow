$(function () {
  let postLength = $('#post-length').val();

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

  for (let i = 1; i <= postLength; i++) {
    $('#add-upvote-' + i).click(function (e) {
      let upvote = parseInt($('.text-upvote-' + i).html()) + 1;
      $('.text-upvote-' + i).html(upvote);
      e.preventDefault();
    });
  }

  for (let i = 1; i <= postLength; i++) {
    $('#add-downvote-' + i).click(function (e) {
      let downvote = parseInt($('.text-downvote-' + i).html()) + 1;
      $('.text-downvote-' + i).html(downvote);
      e.preventDefault();
    });
  }
});