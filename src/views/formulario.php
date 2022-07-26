<?php
    require 'topo.php';
?>

<body>
    <main>
        <form class="mt-3 container" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="arquivo" class="form-label">Selecione o arquivo para fazer upload</label>
                <input name="arquivo" type="file" class="form-control" id="arquivo">
            </div>
            <button type="submit" id="submit" class="btn btn-primary">Enviar</button>
        </form>
    </main>
</body>

<?php
    require 'rodape.php';
?>