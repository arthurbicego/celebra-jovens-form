<?php
$__ROOT__ = __DIR__;

require_once($__ROOT__ . "/globals.php");
require_once($__ROOT__ . "/database.php");

$ministriesLimit = [
    'vocalmasc' => 5,
    'vocalfem' => 10,
    'violao' => 5,
    'teclado' => 5,
    'guitarra' => 5,
    'bateria' => 5,
    'baixo' => 5,
    'cozinha' => 32,
    'imagem' => 10,
    'som' => 10,
    'fotos' => 10,
    'recepcaomasc' => 5,
    'recepcaofem' => 5,
    'limpeza' => 32
];
$userAnswers = [];

function validateIsUserRegisteredInMinsitry($userAnswers, $result)
{
    $louvor = ['vocalmasc', 'vocalfem', 'violao', 'teclado', 'guitarra', 'bateria', 'baixo'];

    $recepcao = ['recepcaomasc', 'recepcaofem'];

    foreach ($userAnswers as $ministry => $choice) {
        if ($choice === true) {

            foreach ($result as $index => $dataLine) {

                // Usuário já está no louvor
                if (in_array($ministry, $louvor)) {

                    foreach ($dataLine as $key => $value) {
                        if (in_array($key, $louvor) && $value) {
                            return true;
                        }
                    }
                }

                // Usuário já está na recepção
                if (in_array($ministry, $recepcao)) {

                  foreach ($dataLine as $key => $value) {
                      if (in_array($key, $recepcao) && $value) {
                          return true;
                      }
                  }
              }

                // Usuário já está no ministério escolhido
                if ($dataLine[$ministry]) {
                    return true;
                }
            }
            return false;
        } else {
            // algum erro - não deveria ser submetido um formulário sem nenhum 'true'
        }
    }
}

function validateIsUserInMaxMinistries($userAnswers, $result)
{
    $count = 0;

    foreach($result as $singleResponse => $dataLine) {
      foreach ($dataLine as $ministry => $value) {
        if ($value && $ministry !== 'nome' && $ministry !== 'email' && $ministry !== 'id' && $ministry !== 'limpeza') {
          $count++;
        }
    }
  }

    // Verificar se o usuário já está em 2 ou mais ministérios que não são "limpeza"
    if ($count < 2 || $userAnswers['limpeza']) {
        return false;
    } else {
        return true;
    }
}

function validateIsMinistryFull($conn, $userAnswers, $ministriesLimit)
{
    foreach ($userAnswers as $ministry => $value) {
        if ($value === true) {

            $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE $ministry = :true");
            $trueValue = true;
            $stmt->bindParam(":true", $trueValue);
            $stmt->execute();
            $result = intval($stmt->fetchColumn());

            if ($ministriesLimit[$ministry] < $result + 1) {
                return true;
            } else {
                return false;
            }
        } else {
            // algum erro - não deveria ser submetido um formulário sem nenhum 'true'
        }
    }
}

function loadPageIsMinistryFull($conn, $ministriesLimit)
{
    $stmt = $conn->prepare("SELECT
        SUM(vocalmasc) AS vocalmasc,
        SUM(vocalfem) AS vocalfem,
        SUM(violao) AS violao,
        SUM(teclado) AS teclado,
        SUM(guitarra) AS guitarra,
        SUM(bateria) AS bateria,
        SUM(baixo) AS baixo,
        SUM(cozinha) AS cozinha,
        SUM(imagem) AS imagem,
        SUM(som) AS som,
        SUM(fotos) AS fotos,
        SUM(recepcaomasc) AS recepcaomasc,
        SUM(recepcaofem) AS recepcaofem,
        SUM(limpeza) AS limpeza
        FROM users");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    foreach ($result as $ministry => $value) {
        if ($ministriesLimit[$ministry] <= intval($value)) {
            $result[$ministry] = true;
        } else {
            $result[$ministry] = false;
        }
    }
    return $result;
}

function create($conn, $userAnswers)
{
    $stmt = $conn->prepare("INSERT INTO users (
nome, email, vocalmasc, vocalfem, violao, teclado, guitarra, bateria, baixo, cozinha, imagem, som, fotos, recepcaomasc, recepcaofem, limpeza
) VALUES (
:nome, :email, :vocalmasc, :vocalfem, :violao, :teclado, :guitarra, :bateria, :baixo, :cozinha, :imagem, :som, :fotos, :recepcaomasc, :recepcaofem, :limpeza
)");

    $stmt->bindParam(":nome", $userAnswers["nome"]);
    $stmt->bindParam(":email", $userAnswers["email"]);
    $stmt->bindParam(":vocalmasc", $userAnswers["vocalmasc"]);
    $stmt->bindParam(":vocalfem", $userAnswers["vocalfem"]);
    $stmt->bindParam(":violao", $userAnswers["violao"]);
    $stmt->bindParam(":teclado", $userAnswers["teclado"]);
    $stmt->bindParam(":guitarra", $userAnswers["guitarra"]);
    $stmt->bindParam(":bateria", $userAnswers["bateria"]);
    $stmt->bindParam(":baixo", $userAnswers["baixo"]);
    $stmt->bindParam(":cozinha", $userAnswers["cozinha"]);
    $stmt->bindParam(":imagem", $userAnswers["imagem"]);
    $stmt->bindParam(":som", $userAnswers["som"]);
    $stmt->bindParam(":fotos", $userAnswers["fotos"]);
    $stmt->bindParam(":recepcaomasc", $userAnswers["recepcaomasc"]);
    $stmt->bindParam(":recepcaofem", $userAnswers["recepcaofem"]);
    $stmt->bindParam(":limpeza", $userAnswers["limpeza"]);

    $stmt->execute();
}

function sendEmail($userAnswers)
{
    $ministriesTitle = [
        'vocalmasc' => 'Louvor (Vocal Masculino)',
        'vocalfem' => 'Louvor (Vocal Feminino)',
        'violao' => 'Louvor (Violão)',
        'teclado' => 'Louvor (Teclado)',
        'guitarra' => 'Louvor (Guitarra)',
        'bateria' => 'Louvor (Bateria)',
        'baixo' => 'Louvor (Baixo)',
        'cozinha' => 'Cozinha',
        'imagem' => 'Imagem / Projeção',
        'som' => 'Som',
        'fotos' => 'Fotos / Insta',
        'recepcaomasc' => 'Recepção (Masculino)',
        'recepcaofem' => 'Recepção (Feminino)',
        'limpeza' => 'Limpeza',
    ];

    // sensitive information
    $ministriesWhatsapp = [
        'vocalmasc' => 'sensitive information',
        'vocalfem' => 'sensitive information',
        'violao' => 'sensitive information',
        'teclado' => 'sensitive information',
        'guitarra' => 'sensitive information',
        'bateria' => 'sensitive information',
        'baixo' => 'sensitive information',
        'cozinha' => 'sensitive information',
        'imagem' => 'sensitive information',
        'som' => 'sensitive information',
        'fotos' => 'sensitive information',
        'recepcaomasc' => 'sensitive information',
        'recepcaofem' => 'sensitive information',
        'limpeza' => 'sensitive information',
    ];

    foreach ($userAnswers as $ministry => $choice) {
        if ($choice === true) {

            $to = $userAnswers['email'];
            $subject = 'Celebra Jovens - Escala Ministerial 2024.2';
            $bodyMessage = "Parabéns, " . $userAnswers['nome'] . "!\n\n" .
                "Você está na Escala Ministerial 2024.2 do Ministério de $ministriesTitle[$ministry]. Clique no link para entrar no grupo do WhatsApp deste ministério:\n\n" .
                "$ministriesWhatsapp[$ministry]\n\n" .
                "Deus abençoe!\n\n" .
                "Att,\n" .
                "Celebra Jovens.";
            $message    = $bodyMessage;
            $headers = 'From: contato@celebrajovens.org';

            mail($to, $subject, $message, $headers);
        } else {
            // algum erro - não deveria ser submetido um formulário sem nenhum 'true'
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userAnswers["nome"] = $_POST["nome"];
    $userAnswers["email"] = $_POST["email"];

    $louvor = [
        "vocalmasc",
        "vocalfem",
        "violao",
        "teclado",
        "guitarra",
        "bateria",
        "baixo",
    ];

    foreach ($louvor as $keyX) {
        if ($keyX === $_POST["louvorChoice"]) {
            $userAnswers[$keyX] = true;
        } else {
            $userAnswers[$keyX] = false;
        };
    }

    $recepcao = [
      "recepcaomasc",
      "recepcaofem",
    ];

    foreach ($recepcao as $keyY) {
      if ($keyY === $_POST["recepcaoChoice"]) {
          $userAnswers[$keyY] = true;
      } else {
          $userAnswers[$keyY] = false;
      };
  }

    foreach ($ministriesLimit as $key => $value) {
        if (isset($_POST[$key])) {
            $userAnswers[$key] = filter_var($_POST[$key], FILTER_VALIDATE_BOOLEAN);
        }
    }

    // CONSULTAR EMAIL
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(":email", $userAnswers["email"]);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!validateIsUserRegisteredInMinsitry($userAnswers, $result)) {

        if (!validateIsUserInMaxMinistries($userAnswers, $result)) {

            if (!validateIsMinistryFull($conn, $userAnswers, $ministriesLimit)) {
                create($conn, $userAnswers);
                sendEmail($userAnswers);
                header("Location: confirmed.php?parameter=confirmed");
            } else {
                header("Location: confirmed.php?parameter=ministryisfull");
            }
        } else {
            header("Location: confirmed.php?parameter=userisinmaxministries");
        }
    } else {
        header("Location: confirmed.php?parameter=userisregisteredinministry");
    }

    exit;
}
