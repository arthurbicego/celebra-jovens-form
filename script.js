function clearFields() {
  var inputs = document.querySelectorAll("input");
  inputs.forEach(function (input) {
    input.value = "";
  });

  var selects = document.querySelectorAll("select");
  selects.forEach(function (select) {
    select.value = "";
  });

  var radios = document.querySelectorAll('input[type="radio"]');
  radios.forEach(function (radio) {
    radio.checked = radio.defaultChecked;
  });
}

document.addEventListener("DOMContentLoaded", function () {
  // Carregar se o ministério está lotado (true) ou não (false) -------------------------------------------------------------
  // Coloquei essa linha lá no php
  // var ministryVacancies = <?php echo json_encode(loadPageIsMinistryFull($conn, $ministriesLimit)); ?>;
  var isLouvorFull =
    ministryVacancies["vocalmasc"] &&
    ministryVacancies["vocalfem"] &&
    ministryVacancies["violao"] &&
    ministryVacancies["teclado"] &&
    ministryVacancies["guitarra"] &&
    ministryVacancies["bateria"] &&
    ministryVacancies["baixo"];

  const louvor = [
    "vocalmasc",
    "vocalfem",
    "violao",
    "teclado",
    "guitarra",
    "bateria",
    "baixo",
  ];

  // Se o louvor estiver cheio
  if (isLouvorFull) {
    // Desabilitar o botão "Servir"
    var inputElementLouvor = document.getElementById("louvorTrue");
    inputElementLouvor.disabled = true;
    var choiceLabelLouvor = document.getElementById("louvorServir");
    choiceLabelLouvor.style.color = "#cacaca";
    // Adicionar mensagem de esgotado
    var labelElementLouvor = document.getElementById("louvorLabel");
    labelElementLouvor.innerText += " - Esgotado!";
    labelElementLouvor.classList.add("text-red-600");
  }

  // RECEPCAO ----------------------------------
  var isRecepcaoFull =
    ministryVacancies["recepcaomasc"] &&
    ministryVacancies["recepcaofem"];

  const recepcao = [
    "recepcaomasc",
    "recepcaofem",
  ];

  // Se a recepção estiver cheia
  if (isRecepcaoFull) {
    // Desabilitar o botão "Servir"
    var inputElementRecepcao = document.getElementById("recepcaoTrue");
    inputElementRecepcao.disabled = true;
    var choiceLabelRecepcao = document.getElementById("recepcaoServir");
    choiceLabelRecepcao.style.color = "#cacaca";
    // Adicionar mensagem de esgotado
    var labelElementRecepcao = document.getElementById("recepcaoLabel");
    labelElementRecepcao.innerText += " - Esgotado!";
    labelElementRecepcao.classList.add("text-red-600");
  }

  // Se o ministério/instrumento estiver cheio
  Object.keys(ministryVacancies).forEach((ministry) => {
    if (ministryVacancies[ministry]) {
      // Se for instrumento do louvor
      if (louvor.includes(ministry)) {
        var optionToDisable = document.querySelector(
          "option[value=" + ministry + "]"
        );
        optionToDisable.disabled = true;
        optionToDisable.text = optionToDisable.text + " - Esgotado!";
        optionToDisable.classList.add("text-red-600");
      } else if (recepcao.includes(ministry)) {
        var optionToDisable = document.querySelector(
          "option[value=" + ministry + "]"
        );
        optionToDisable.disabled = true;
        optionToDisable.text = optionToDisable.text + " - Esgotado!";
        optionToDisable.classList.add("text-red-600");
      } else {
        // Desabilitar o botão "Servir"
        var inputElement = document.getElementById(ministry + "True");
        inputElement.disabled = true;
        var choiceLabel = document.getElementById(ministry + "Servir");
        choiceLabel.style.color = "#cacaca";
        // Adicionar mensagem de esgotado
        var labelElement = document.getElementById(ministry + "Label");
        labelElement.innerText += " - Esgotado!";
        labelElement.classList.add("text-red-600");
      }
    }
  });

  // Validações de formulário -----------------------------------------------------------------------------------------------
  var form = document.querySelector("form"); // Captura o formulário
  form.addEventListener("submit", function (event) {
    // Valida confirmação de email
    var email = document.getElementById("email").value;
    var confirmEmail = document.getElementById("confirmEmail").value;
    if (email !== confirmEmail) {
      alert("Os campos de e-mail não coincidem.");
      event.preventDefault(); // Evita o envio do formulário
      return;
    }

    // Valida número de ministérios escolhidos
    var ministryCount = 0;
    var selects = form.querySelectorAll(
      'input[type="radio"][value="true"]:checked'
    );
    selects.forEach(function (select) {
      if (select.value === "true") {
        ministryCount++;
      }
    });
    if (ministryCount !== 1) {
      alert("Você deve selecionar 1 ministério por formulário.");
      event.preventDefault(); // Evita o envio do formulário
      ministryCount = 0;
      return;
    }

    // Valida Instrumento selecionado
    var louvorChecked = document.getElementById("louvorTrue").checked;
    var louvorChoiceValue = document.getElementById("louvorChoice").value;
    if (louvorChecked && louvorChoiceValue === "") {
      alert("Você deve selecionar um instrumento.");
      event.preventDefault(); // Evita o envio do formulário
      return;
    }

    // Valida Louvor selecionado
    if (!louvorChecked && louvorChoiceValue !== "") {
      alert(
        "Você selecionou um instrumento, mas não clicou para servir no Louvor. Ou retire o instrumento selecionado, ou selecione o Louvor para servir."
      );
      event.preventDefault(); // Evita o envio do formulário
      return;
    }

    // Valida Gênero selecionado
    var recepcaoChecked = document.getElementById("recepcaoTrue").checked;
    var recepcaoChoiceValue = document.getElementById("recepcaoChoice").value;
    if (recepcaoChecked && recepcaoChoiceValue === "") {
      alert("Você deve selecionar um gênero na recepção.");
      event.preventDefault(); // Evita o envio do formulário
      return;
    }

    // Valida Recepção selecionado
    if (!recepcaoChecked && recepcaoChoiceValue !== "") {
      alert(
        "Você selecionou um gênero na Recepção, mas não clicou para servir no Recepção. Ou retire o gênero selecionado, ou selecione a Recepção para servir."
      );
      event.preventDefault(); // Evita o envio do formulário
      return;
    }
  });
});
