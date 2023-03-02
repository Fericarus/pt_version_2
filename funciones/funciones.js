// Validar nombre
function validarNombre(id) {
  var nombre = document.getElementById(id).value;
  var errorMessageNombre = document.getElementById("errorMessageNombre");
  var Pattern = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;

  // Validamos contra la expresión regular
  if (!Pattern.test(nombre)) {
    errorMessageNombre.innerHTML = "Solo se permiten letras y espacios.";
    errorMessageNombre.style.backgroundColor = "red";
    errorMessageNombre.style.color = "white";
    errorMessageNombre.style.display = "block";
    errorMessageNombre.style.padding = ".5rem";
    errorMessageNombre.style.paddingLeft = paddingLeft + "rem";
    return false;
  } else {
    errorMessageNombre.innerHTML = "";
    errorMessageNombre.style.display = "none";
    return true;
  }
}

// Validar apellido paterno
function validarPaterno(id) {
  var apellido_paterno = document.getElementById(id).value;
  var errorMessagePaterno = document.getElementById("errorMessagePaterno");
  var Pattern = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;

  // Validamos contra la expresión regular
  if (!Pattern.test(apellido_paterno)) {
    errorMessagePaterno.innerHTML = "Solo se permiten letras";
    errorMessagePaterno.style.backgroundColor = "red";
    errorMessagePaterno.style.color = "white";
    errorMessagePaterno.style.display = "block";
    errorMessagePaterno.style.padding = ".5rem";
    errorMessagePaterno.style.paddingLeft = paddingLeft + "rem";
    return false;
  } else {
    errorMessagePaterno.innerHTML = "";
    errorMessagePaterno.style.display = "none";
    return true;
  }
}

// Validar apellido Materno
function validarMaterno(id) {
  var apellido_materno = document.getElementById(id).value;
  var errorMessageMaterno = document.getElementById("errorMessageMaterno");
  var Pattern = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;

  // Validamos contra la expresión regular
  if (!Pattern.test(apellido_materno)) {
    errorMessageMaterno.innerHTML = "Solo se permiten letras";
    errorMessageMaterno.style.backgroundColor = "red";
    errorMessageMaterno.style.color = "white";
    errorMessageMaterno.style.display = "block";
    errorMessageMaterno.style.padding = ".5rem";
    errorMessageMaterno.style.paddingLeft = paddingLeft + "rem";
    return false;
  } else {
    errorMessageMaterno.innerHTML = "";
    errorMessageMaterno.style.display = "none";
    return true;
  }
}

// Validar letras
function validarLetras(id, paddingLeft) {
  var apellido_materno = document.getElementById(id).value;
  var errorMessageLetras = document.getElementById("errorMessageLetras");
  var Pattern = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;

  // Validamos contra la expresión regular
  if (!Pattern.test(apellido_materno)) {
    errorMessageLetras.innerHTML = "Solo se permiten letras";//////////////////////////////////////
    errorMessageLetras.style.backgroundColor = "red";
    errorMessageLetras.style.color = "white";
    errorMessageLetras.style.display = "block";
    errorMessageLetras.style.padding = ".5rem";
    errorMessageLetras.style.paddingLeft = paddingLeft + "rem";
    return false;
  } else {
    errorMessageLetras.innerHTML = "";
    errorMessageLetras.style.display = "none";
    console.log("Desde JS");
    return true;
  }
}

// Función para validar el email
function validarEmail(id) {
  var email = document.getElementById(id).value;
  var errorMessageEmail = document.getElementById("errorMessageEmail");
  var Pattern = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

  // Validamos contra la expresión regular
  if (!Pattern.test(email)) {
    errorMessageEmail.innerHTML = "Escriba un correo válido";
    errorMessageEmail.style.backgroundColor = "red";
    errorMessageEmail.style.color = "white";
    errorMessageEmail.style.display = "block";
    errorMessageEmail.style.padding = ".5rem";
    errorMessageEmail.style.paddingLeft = paddingLeft + "rem";
    return false;
  } else {
    errorMessageEmail.innerHTML = "";
    errorMessageEmail.style.display = "none";
    return true;
  }
}

// Función para validar el telefono
function validarTelefono(id) {
  var telefono = document.getElementById(id).value;
  var errorMessageTelefono = document.getElementById("errorMessageTelefono");
  var Pattern = /^\d{10}$/;

  // Validamos contra la expresión regular
  if (!Pattern.test(telefono)) {
    errorMessageTelefono.innerHTML = "Escriba un teléfono válido. 10 dígitos";
    errorMessageTelefono.style.backgroundColor = "red";
    errorMessageTelefono.style.color = "white";
    errorMessageTelefono.style.display = "block";
    errorMessageTelefono.style.padding = ".5rem";
    errorMessageTelefono.style.paddingLeft = paddingLeft + "rem";
    return false;
  } else {
    errorMessageTelefono.innerHTML = "";
    errorMessageTelefono.style.display = "none";
    return true;
  }
}

// Función para validar el password
function validarPass(id) {
  var password1 = document.getElementById(id).value;
  var errorMessagePass = document.getElementById("errorMessagePass");
  var Pattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%#?&])[A-Za-z\d@$!%*#?&]{8,}$/;

  // Validamos contra la expresión regular
  if (!Pattern.test(password1)) {
    errorMessagePass.innerHTML = "Las contraseñas deben tener al menos 8 caracteres, una letra minúscula, una mayúscula, un número y un caracter especial";
    errorMessagePass.style.backgroundColor = "red";
    errorMessagePass.style.color = "white";
    errorMessagePass.style.display = "block";
    errorMessagePass.style.padding = ".5rem";
    errorMessagePass.style.paddingLeft = paddingLeft + "rem";
    return false;
  } else {
    errorMessagePass.innerHTML = "";
    errorMessagePass.style.display = "none";
    return true;
  }
}

// Función para validar el password confirm
function validarPassConfirm(id) {
  var passwordConfirm = document.getElementById(id).value;
  var errorMessagePassConfirm = document.getElementById("errorMessagePassConfirm");
  var Pattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%#?&])[A-Za-z\d@$!%*#?&]{8,}$/;

  // Validamos contra la expresión regular
  if (!Pattern.test(passwordConfirm)) {
    errorMessagePassConfirm.innerHTML = "Las contraseñas deben tener al menos 8 caracteres, una letra minúscula, una mayúscula, un número y un caracter especial.";
    errorMessagePassConfirm.style.backgroundColor = "red";
    errorMessagePassConfirm.style.color = "white";
    errorMessagePassConfirm.style.display = "block";
    errorMessagePassConfirm.style.padding = ".5rem";
    errorMessagePassConfirm.style.paddingLeft = paddingLeft + "rem";
    return false;
  } else {
    errorMessagePassConfirm.innerHTML = "";
    errorMessagePassConfirm.style.display = "none";
    return true;
  }
}
