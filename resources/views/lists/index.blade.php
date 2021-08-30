<!doctype html>
<html lang="{{{ str_replace('_', '-', app()->getLocale()) }}}">
<head>
    <meta charset="utf-8">

    <title>{{ config('app.name', 'App') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1>List of all available surveys</h1>
          <p>Type something in the input field to search the table for survey codes and names:</p>
          <input class="form-control" id="myInput" type="text" placeholder="Search">
          <br>
          <table class="table table-striped table-dark">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Code / Name</th>
                <th scope="col">Link</th>
              </tr>
            </thead>
            <tbody id="myTable">
              <?php $counter = 1; ?>
          <?php foreach ($data as $key => $value) : ?>
            <tr>
              <th scope="row"><?= $counter ?></th>
              <td class="survey-code"><?= $key ?></td>
              <td><a href="<?= $value ?>" target="_blank">More Info</a></td>
            </tr>
            <?php $counter++; ?>
          <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
    jQuery(document).ready(function($){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).find('td.survey-code').text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    </script>
</body>
</html>
