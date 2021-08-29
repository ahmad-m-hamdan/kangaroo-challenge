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
          <h1>Details for survey: <?= $code ?></h1>
          <table class="table table-striped table-dark">
            <tbody>
          <?php foreach ($data as $answer) : ?>
            <?php if ($answer->type == 'qcm'): ?>
            <tr>
              <td colspan="2" class="text-center"><?= $answer->label ?></td>
            </tr>
            <?php foreach ($answer->result as $key => $value): ?>
            <tr>
              <td><?= $key ?></td>
              <td><?= $value ?></td>
            </tr>
            <?php endforeach; ?>
            <?php elseif ($answer->type == 'numeric'): ?>
            <tr>
              <td colspan="2" class="text-center"><?= $answer->label ?></td>
            </tr>
            <tr>
              <td>Sum</td>
              <td><?= $answer->result ?></td>
            </tr>
            <?php endif; ?>
          <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</body>
</html>
