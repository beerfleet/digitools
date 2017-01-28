$(document).ready(function () {
  lock_die();
  score();
});

function lock_die() {
  $(".die").on("click", function () {
    console.log($(this).attr('name'));
    $die = $(this);
    die = $(this).attr('name');

    switch (die) {
      case "die1":
        $lock = $('#lock-die1');
        break;
      case "die2":
        $lock = $('#lock-die2');
        break;
      case "die3":
        $lock = $('#lock-die3');
        break;
      case "die4":
        $lock = $('#lock-die4');
        break;
      case "die5":
        $lock = $('#lock-die5');
        break;
      case "die6":
        $lock = $('#lock-die6');
        break;
    }

    toggle_lock($lock, $die);

  });
}

function score() {
  score_ones();
  score_twos();
  score_threes();
  score_fours();
  score_fives();
  score_sixes();
}

function score_ones() {
  $("input[name='ones']").on('click', function () {
    // note score on scoreboard
    $dice = $(".die");
    score = count_same(1, $dice);
    // add score to session

  });
}

function score_twos() {
  $("input[name='twos']").on('click', function () {
    // note score on scoreboard
    $dice = $(".die");
    score = count_same(2, $dice);
    // add score to session

  });
}

function score_threes() {
  $("input[name='threes']").on('click', function () {
    // note score on scoreboard
    $dice = $(".die");
    score = count_same(3, $dice);
    // add score to session

  });

}

function score_fours() {
  $("input[name='fours']").on('click', function () {
    // note score on scoreboard
    $dice = $(".die");
    score = count_same(4, $dice);
    // add score to session

  });
}

function score_fives() {
  $("input[name='fives']").on('click', function () {
    // note score on scoreboard
    $dice = $(".die");
    score = count_same(5, $dice);
    // add score to session

  });
}

function score_sixes() {
  $("input[name='sixes']").on('click', function () {
    // note score on scoreboard
    $dice = $(".die");
    score = count_same(6, $dice);
    // add score to session

  });
}

function count_same(eyes, $dice) {
  score = 0;
  $dice.each(function (index, value) {
    val = $(this).val();
    if (parseInt(val) == parseInt(eyes)) {
      score += parseInt(val);
    }
  });
  console.log(score);
}

function toggle_lock($lock, $die) {
  if ($lock.is(':checked')) {
    $lock.prop('checked', false);
    $die.removeClass('locked');
  } else {
    $lock.prop('checked', true);
    $die.addClass('locked');
  }
}