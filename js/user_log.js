$(document).ready(function () {
  // Get Report passenger
  $(document).on('click', '#user_log', function () {

    var date_sel = $('#date_sel').val();

    $.ajax({
      url: 'user_log_up.php',
      type: 'POST',
      data: {
        'log_date': 1,
        'date_sel': date_sel,
      },
      success: function (response) {
        $.ajax({
          url: "user_log_up.php",
          type: 'POST',
          data: {
            'log_date': 1,
            'date_sel': date_sel,
            'select_date': 0,
          }
        }).done(function (data) {
          $('#userslog').html(data);
        });
      }
    });
  });
});

$(document).on('click', '#user_log_class', function () {
  var student_class = $('#student_class').val();
  var tanggal = $('#tanggal').val();

  $.ajax({
    url: 'user_log_up_class.php',
    type: 'POST',
    data: {
      'log_date': 1,
      'student_class': student_class,
      'tanggal': tanggal,
    },
    success: function (response) {
      $.ajax({
        url: "user_log_up_class.php",
        type: 'POST',
        data: {
          'log_date': 1,
          'student_class': student_class,
          'tanggal': tanggal,
          'select_date': 0,
        }
      }).done(function (data) {
        $('#userslog').html(data);
      });
    }
  });
});
