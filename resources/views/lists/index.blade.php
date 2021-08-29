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
          <table class="table table-striped table-dark">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Code</th>
                <th scope="col">Link</th>
              </tr>
            </thead>
            <tbody>
              <?php $counter = 1; ?>
          <?php foreach ($data as $key => $value) : ?>
            <tr>
              <th scope="row"><?= $counter ?></th>
              <td><?= $key ?></td>
              <td><a href="<?= $value ?>" target="_blank">More Info</a></td>
            </tr>
            <?php $counter++; ?>
          <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</body>
</html>
