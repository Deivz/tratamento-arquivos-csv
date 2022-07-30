<?php
require 'topo.php';
?>

<body>
    <main class="mt-3 container">
        <h2>Transações importadas</h2>
        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Data transações</th>
                        <th scope="col">Data importação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($_SESSION['importacoes'] as $importacao) : ?>
                            <td><?= $importacao['data_transacao'] ?></td>
                            <td><?= $importacao['datahora_importacao'] ?></td>
                        <?php endforeach ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</body>

<?php
unset($_SESSION['importacoes']);
require 'rodape.php';
?>