<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php $i = 1; ?>
    <div class="container mt-4  ">
        <!-- <div class="row">
            <form action="">
                <div class="row">
                    <div class="col-4">
                        <input type="text" name="nombre" class="form-control" placeholder="nombre">
                    </div>
                    <div class="col-3">
                        <input type="text" name="nombre" class="form-control" placeholder="paterno">
                    </div>
                    <div class="col-3">
                        <input type="text" name="nombre" class="form-control" placeholder="materno">
                    </div>
                </div>
            </form>

        </div> -->
        <table class="table mt-4    ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>CI</th>
                    <th>Nombre</th>
                    <th>Paterno</th>
                    <th>Fecha</th>
                    <th>em</th>
                    <th>sm</th>
                    <th>et</th>
                    <th>st</th>
                    <th>mr</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $value) : ?>
                    <tr>
                        <td scope="row"><?= $i;
                                        $i++ ?></td>
                        <td scope="row"><?= $value['ci'] ?></td>
                        <td scope="row"><?= $value['nombre'] ?></td>
                        <td scope="row"><?= $value['paterno'] ?></td>
                        <td scope="row"><?= $value['fecha'] ?></td>
                        <td scope="row"><?= $value['em'] ?></td>
                        <td scope="row"><?= $value['sm'] ?></td>
                        <td scope="row"><?= $value['et'] ?></td>
                        <td scope="row"><?= $value['st'] ?></td>
                        <td scope="row"><?= $value['mr'] ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>