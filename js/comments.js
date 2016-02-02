$(function () {
  initializeHandler();
});

function initializeHandler() {
  $('#add-comment').on('click', function () {
    id = $('#comment-box').data('whiskyid');
    comment_text = $('#comment-box').val();
    $.ajax({
      url: '/whisky/addcomment/' + id,
      type: 'POST',
      data: {text: comment_text}
    });
    ui_add_comment(comment_text);
  });
}

function ui_add_comment(comment_text) {
  $comment = $('<div class="comment"></div>');
  $comment_head = $('<div class="comment-head">');      
  $date = $('<span class="comment-date">Recent post: </span>');  
  $comment_head.append($date);
  $comment_body = $('<div class="comment-body">'+ comment_text +'</div>');
  $comment.append($comment_head);
  $comment.append($comment_body);
  $('#comments').append($comment);
}