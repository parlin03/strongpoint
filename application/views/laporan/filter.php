<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha512-iQQV+nXtBlmS3XiDrtmL+9/Z+ibux+YuowJjI4rcpO7NYgTzfTOiFNm09kWtfZzEB9fQ6TwOVc8lFVWooFuD/w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <h1 align="center"><?= $title; ?></h1>
        <br>
        <div class="row">
            <div class="col-md-3">
                <form action="" id="FormLaporan">
                    <select name="" id="kecamatan" class="form-control">
                        <option value="0">Show All</option>
                        <?php foreach ($kecamatan as $row) : ?>
                            <option value="<?= $row->idkec; ?>"><?= $row->namakec; ?></option>
                        <?php endforeach ?>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary">Show Data</button>
                </form>

            </div>
            <div class="col-md-9">
                <div id="result"></div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // alert('hello');
        $(document).ready(function() {
            $("#FormLaporan").submit(function(e) {
                e.preventDefault();
                var id = $("#kecamatan").val();
                // console.log(id);
                var url = "<?= site_url('Cetak_Filter/filter/') ?>" + id;
                $('#result').load(url);
            })
        });
    </script> 
</body>

</html>