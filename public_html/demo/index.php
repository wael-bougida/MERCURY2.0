<!DOCTYPE html>
<html>

<head>
     <title>DEMO</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
     <script src="//code.jquery.com/jquery-1.12.4.js"></script>
     <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
     <style>
          ul {
               background-color: #eee;
               cursor: pointer;
          }

          li {
               padding: 12px;
          }
     </style>
<body>
     <br /><br />
     <div class="container" style="width:500px;">
          <h3 align="center">DEMO</h3><br />
          <label>Enter Student Name</label>
          <input type="text" name="student_name" id="student_name" class="form-control" placeholder="Enter Student Name" />
          <div id="studentList"></div>
     </div>
</body>

</html>
<script>
     $(document).ready(function() {
          // This includes the bonus point. Every time the user type an input -> send a request (AJAX)
          $('#student_name').autocomplete({
               source: function(request, response) {
                    var query = request.term;
                    if (query != '') {
                         $.ajax({
                              url: "search.php",
                              method: "POST",
                              data: {
                                   query: query
                              },
                              success: function(data) {
                                   $('#studentList').fadeIn();
                                   $('#studentList').html(data);
                              }
                         });
                    }
               },
          });

          $(document).on('click', 'li', function() {
               $('#student_name').val($(this).text());
               $('#studentList').fadeOut();
          });
     });
</script>