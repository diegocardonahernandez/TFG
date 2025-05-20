document
  .getElementById("verTodosProductos")
  .addEventListener("click", function () {
    var dropdownToggle = document.getElementById("dropdownTienda");
    var dropdown = new bootstrap.Dropdown(dropdownToggle);
    dropdown.show();
  });
