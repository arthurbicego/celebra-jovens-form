<?php

$__ROOT__ = __DIR__;

require_once($__ROOT__ . "/logic.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Celebra Jovens</title>
    <link rel="icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center bg-no-repeat bg-top bg-cover bg-celebrabg">

    <div class="bg-white px-8 py-6 rounded shadow-md max-w-sm w-full space-y-2">
        <div class="flex items-center justify-center">
            <img src="logo.png" alt="Image" class="w-14 h-14 rounded-full mr-2">
        </div>
        <div class="flex items-center justify-center mb-2">
            <h1 class="text-xl font-bold text-celebraverde mr-1.5">CELEBRA JOVENS</h1>
            <h1 class="text-xl font-bold text-celebraazul">2024.2</h1>
        </div>

        <hr class="bg-celebraverde h-0.5">
        <div class="">

            <ul class="space-y-0.5 italic">
                <p>- 1 Ministério por formulário.</p>
                <p>- Usar o mesmo e-mail nos formulários.</p>
                <p>- Louvor: 1 instrumento por pessoa.</p>
                <p>- Máx. 2 ministérios por pessoa (o ministério da Limpeza não entra nessa regra).</p>
            </ul>
        </div>

        <hr class="bg-celebraverde h-0.5">

        <form method="post" action="" class="space-y-4">
            <div>
                <label for="nome" class="block font-semibold">Nome Completo</label>
                <input type="text" name="nome" id="nome" class="mt-1 block w-full p-2 border rounded" required>
            </div>
            <div>
                <label for="email" class="block font-semibold">E-mail</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full p-2 border rounded" required>
            </div>
            <div>
                <label for="confirmEmail" class="block font-semibold">Confirme o E-mail</label>
                <input type="email" name="confirmEmail" id="confirmEmail" class="mt-1 block w-full p-2 border rounded" required>
            </div>

            <hr class="bg-celebraverde h-0.5">

            <!-- LOUVOR -->
            <div>
                <label for="louvorChoice" class="font-semibold">Louvor</label>
                <select name="louvorChoice" id="louvorChoice" class="block w-50 p-2 border rounded">
                    <option value="">Selecionar</option>
                    <option class="" value="vocalmasc">Vocal Masculino</option>
                    <option class="" value="vocalfem">Vocal Feminino</option>
                    <option class="" value="violao">Violão</option>
                    <option class="" value="teclado">Teclado</option>
                    <option class="" value="guitarra">Guitarra</option>
                    <option class="" value="bateria">Bateria</option>
                    <option class="" value="baixo">Baixo</option>
                </select>
                <div id="louvor" class="">
                    <div class="relative">
                        <label id="louvorLabel" class="font-semibold"></label>
                        <div class="my-1">
                            <input type="radio" id="louvorFalse" name="louvor" value="false" checked>
                            <label for="louvorFalse">Não servir</label>

                            <input type="radio" id="louvorTrue" name="louvor" value="true" class="ml-6">
                            <label id="louvorServir" class="" for="louvorTrue">Servir</label>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="bg-celebraverde h-0.5">

            <!-- COZINHA -->
            <div id="cozinha" class="">
                <div class="relative">
                    <label id="cozinhaLabel" class="font-semibold">Cozinha</label>
                    <div class="">
                        <input type="radio" id="cozinhaFalse" name="cozinha" value="false" checked>
                        <label for="cozinhaFalse">Não servir</label>

                        <input type="radio" id="cozinhaTrue" name="cozinha" value="true" class="ml-6">
                        <label id="cozinhaServir" class="" for="cozinhaTrue">Servir</label>
                    </div>
                </div>
            </div>

            <hr class="bg-celebraverde h-0.5">

            <!-- IMAGEM -->
            <div id="imagem" class="">
                <div class="relative">
                    <label id="imagemLabel" class="font-semibold">Imagem / Projeção</label>
                    <div class="">
                        <input type="radio" id="imagemFalse" name="imagem" value="false" checked>
                        <label for="imagemFalse">Não servir</label>

                        <input type="radio" id="imagemTrue" name="imagem" value="true" class="ml-6">
                        <label id="imagemServir" class="" for="imagemTrue">Servir</label>
                    </div>
                </div>
            </div>

            <hr class="bg-celebraverde h-0.5">

            <!-- SOM -->
            <div id="som" class="">
                <div class="relative">
                    <label id="somLabel" class="font-semibold">Som</label>
                    <div class="">
                        <input type="radio" id="somFalse" name="som" value="false" checked>
                        <label for="somFalse">Não servir</label>

                        <input type="radio" id="somTrue" name="som" value="true" class="ml-6">
                        <label id="somServir" class="" for="somTrue">Servir</label>
                    </div>
                </div>
            </div>

            <hr class="bg-celebraverde h-0.5">

            <!-- FOTOS  -->
            <div id="fotos" class="">
                <div class="relative">
                    <label id="fotosLabel" class="font-semibold">Fotos / Insta</label>
                    <div class="">
                        <input type="radio" id="fotosFalse" name="fotos" value="false" checked>
                        <label for="fotosFalse">Não servir</label>

                        <input type="radio" id="fotosTrue" name="fotos" value="true" class="ml-6">
                        <label id="fotosServir" class="" for="somTrue">Servir</label>
                    </div>
                </div>
            </div>

            <hr class="bg-celebraverde h-0.5">

            <!-- RECEPCAO -->
            <div>
                <label for="recepcaoChoice" class="font-semibold">Recepção</label>
                <select name="recepcaoChoice" id="recepcaoChoice" class="block w-50 p-2 border rounded">
                    <option value="">Selecionar</option>
                    <option class="" value="recepcaomasc">Masculino</option>
                    <option class="" value="recepcaofem">Feminino</option>
                </select>
                <div id="recepcao" class="">
                    <div class="relative">
                        <label id="recepcaoLabel" class="font-semibold"></label>
                        <div class="my-1">
                            <input type="radio" id="recepcaoFalse" name="recepcao" value="false" checked>
                            <label for="recepcaoFalse">Não servir</label>

                            <input type="radio" id="recepcaoTrue" name="recepcao" value="true" class="ml-6">
                            <label id="recepcaoServir" class="" for="recepcaoTrue">Servir</label>
                        </div>
                    </div>
                </div>
            </div>


            <hr class="bg-celebraverde h-0.5">

            <!-- LIMPEZA -->
            <div id="limpeza" class="">
                <div class="relative">
                    <label id="limpezaLabel" class="font-semibold">Limpeza</label>
                    <div class="">
                        <input type="radio" id="limpezaFalse" name="limpeza" value="false" checked>
                        <label for="limpezaFalse">Não servir</label>

                        <input type="radio" id="limpezaTrue" name="limpeza" value="true" class="ml-6">
                        <label id="limpezaServir" class="" for="limpezaTrue">Servir</label>
                    </div>
                </div>
            </div>

            <hr class="bg-celebraverde h-0.5">

            <button type="submit" class="bg-celebraverde hover:bg-celebraverdehover text-black px-4 py-2 rounded">Confirmar</button>
        </form>
    </div>

    <script>
        var ministryVacancies = <?php echo json_encode(loadPageIsMinistryFull($conn, $ministriesLimit)); ?>;
    </script>

    <script src="script.js"></script>
</body>

</html>