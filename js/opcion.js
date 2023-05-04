

// Obtener el select y el div del collapse
const select = document.getElementById("mySelect");
const collapse = document.getElementById("collapse");

// Mostrar u ocultar el contenido del collapse según la opción seleccionada
select.addEventListener("change", function() {
  // Obtener el id de la opción seleccionada
  const selectedOptionId = select.value;
  
  // Ocultar todos los elementos del collapse
  const collapseContents = collapse.getElementsByClassName("collapse-content");
  for (let i = 0; i < collapseContents.length; i++) {
    collapseContents[i].style.display = "none";
  }
  
  // Mostrar el contenido correspondiente a la opción seleccionada
  const selectedContent = document.getElementById(selectedOptionId);
  selectedContent.style.display = "block";
});
