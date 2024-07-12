<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Celebra Jovens</title>
    <link rel="icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>

<body class="flex items-center justify-center h-screen bg-no-repeat bg-top bg-cover bg-celebrabg">
    <div id="parameterBanner" class="bg-white p-10 rounded-md shadow-md text-center flex flex-col items-center bg-opacity-65">
        <img src="logo.png" alt="Image" class="w-14 h-14 rounded-full my-2">
        <hr class="w-full bg-gray-500 h-0.5 my-4">
        <h1 class="text-2xl font-bold mb-4"></h1>
        <p class="my-6"></p>
        <a href="./index.php" class=" text-black mt-4 px-4 py-2 rounded-full">Voltar para o formulário</a>
    </div>
</body>

</body>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    const confirmationType = urlParams.get('parameter');
    const banner = document.getElementById('parameterBanner');

    if (confirmationType === 'confirmed') {

        banner.querySelector('h1').textContent = 'CADASTRO REALIZADO!';
        banner.querySelector('h1').classList.add('text-celebraverdehover');
        banner.querySelector('p').textContent = 'Confira seu email (caixa de entrada, spam, lixo eletrônico, etc).';
        banner.querySelector('a').classList.add('bg-celebraverde', 'hover:bg-celebraverdehover');

    } else if (confirmationType === 'ministryisfull') {

        banner.querySelector('h1').textContent = 'ERRO:';
        banner.querySelector('h1').classList.add('text-red-600');
        banner.querySelector('p').textContent = 'A opção escolhida já está esgotada!';
        banner.querySelector('a').classList.add('bg-red-600', 'hover:bg-red-800', 'text-white');

    } else if (confirmationType === 'userisinmaxministries') {

        banner.querySelector('h1').textContent = 'ERRO:';
        banner.querySelector('h1').classList.add('text-red-600');
        banner.querySelector('p').textContent = 'Você já está em 2 ministérios!';
        banner.querySelector('a').classList.add('bg-red-600', 'hover:bg-red-800', 'text-white');

    } else if (confirmationType === 'userisregisteredinministry') {

        banner.querySelector('h1').textContent = 'ERRO:';
        banner.querySelector('h1').classList.add('text-red-600');
        banner.querySelector('p').textContent = 'Você já está cadastrado(a) no ministério escolhido!';
        banner.querySelector('a').classList.add('bg-red-600', 'hover:bg-red-800', 'text-white');

    }
</script>

</html>