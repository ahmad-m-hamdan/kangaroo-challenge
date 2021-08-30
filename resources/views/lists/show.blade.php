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
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= route('default') ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= route('list.index') ?>">Lists</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?= $code ?></li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <?php if (!$data): ?>
            <div class="alert alert-danger" role="alert">
              No information is available for survey code <?= $code ?>
            </div>
          <?php else: ?>
            <h1>Details for survey: <?= $code ?></h1>
            <table class="table table-striped table-dark">
              <tbody>
            <?php foreach ($data as $answer) : ?>
              <tr>
                <td colspan="2" class="text-center"><h2><?= $answer->label ?></h2></td>
              </tr>
              <?php if ($answer->type == 'qcm'): ?>
              <?php foreach ($answer->result as $key => $value): ?>
              <tr>
                <td><?= $key ?></td>
                <td><?= $value ?></td>
              </tr>
              <?php endforeach; ?>
              <?php elseif ($answer->type == 'numeric'): ?>
              <tr>
                <td>Sum</td>
                <td><?= $answer->result ?></td>
              </tr>
              <?php endif; ?>
            <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
</body>
</html>
