<?php
    require 'topo.php';
?>

<body>
    <main>
        <form class="mt-3 container" action="formulario" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="arquivo" class="form-label">Selecione o arquivo para fazer upload</label>
                <input name="arquivo" type="file" class="form-control" id="arquivo">
            </div>
            <button type="submit" id="submit" class="btn btn-primary">Enviar</button>
        </form>
    </main>
    <?php
        if(isset($_SESSION['mensagemErro'])) : ?>
            <div class="container mt-3 alert alert-danger">
                <?= $_SESSION['mensagemErro'] ?>
            </div>
    <?php endif ?>
    <?php
        if(isset($_SESSION['mensagem'])) : ?>
            <div class="container mt-3 alert alert-success">
                <?= $_SESSION['mensagem'] ?>
            </div>
    <?php endif ?>
</body>

<?php
    unset($_SESSION['mensagem']);
    unset($_SESSION['mensagemErro']);
    require 'rodape.php';
?>