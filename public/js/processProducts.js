const productsSkeleton = document.getElementById("productsSkeleton");
const productsTable = document.getElementById("productsTable");
const productsCountSkeleton = document.getElementById("productsCountSkeleton");
const productsCountReal = document.getElementById("productsCountReal");
const productsTableBody = document.getElementById("productsTableBody");
const paginationContainer = document.getElementById("paginationContainer");
const paginationInfo = document.getElementById("paginationInfo");
const noProductsMessage = document.getElementById("noProductsMessage");
const totalProductsSpan = document.getElementById("totalProducts");

let currentPage = 1;

async function fetchAndRenderProducts(page = 1) {
  productsSkeleton.classList.remove("d-none");
  productsTable.classList.add("d-none");
  productsCountSkeleton.classList.remove("d-none");
  productsCountReal.classList.add("d-none");

  try {
    const res = await fetch(`/getProducts?page=${page}`);
    const data = await res.json();

    renderProducts(data.products);
    totalProductsSpan.textContent = data.totalProducts;
    productsCountSkeleton.classList.add("d-none");
    productsCountReal.classList.remove("d-none");
    renderPagination(data.currentPage, data.totalPages);
    if (paginationInfo) {
      if (data.totalProducts > 0) {
        paginationInfo.textContent = `Mostrando ${data.startIndex + 1}-${
          data.endIndex
        } de ${data.totalProducts} productos`;
      } else {
        paginationInfo.textContent = "";
      }
    }
    if (data.products.length === 0) {
      noProductsMessage.classList.remove("d-none");
    } else {
      noProductsMessage.classList.add("d-none");
    }
    productsSkeleton.classList.add("d-none");
    productsTable.classList.remove("d-none");
  } catch (error) {
    productsSkeleton.classList.add("d-none");
    productsTable.classList.remove("d-none");
    noProductsMessage.classList.remove("d-none");
    if (paginationInfo) paginationInfo.textContent = "";
  }
}

function renderProducts(products) {
  productsTableBody.innerHTML = "";
  products.forEach((product) => {
    const row = document.createElement("tr");
    row.className = "product-row";

    let estadoBadgeClass = "bg-light text-dark";
    let estadoIcon = "";
    let estadoText = "";

    switch (product.estado) {
      case "activo":
        estadoBadgeClass = "bg-success text-white";
        estadoIcon = '<i class="bi bi-check-circle-fill me-1"></i>';
        estadoText = "Activo";
        break;
      case "inactivo":
        estadoBadgeClass = "bg-danger text-white";
        estadoIcon = '<i class="bi bi-x-circle-fill me-1"></i>';
        estadoText = "Inactivo";
        break;
      case "agotado":
        estadoBadgeClass = "bg-warning text-dark";
        estadoIcon = '<i class="bi bi-exclamation-triangle-fill me-1"></i>';
        estadoText = "Agotado";
        break;
    }

    row.innerHTML = `
        <td class="px-4 py-3">${product.id_producto}</td>
        <td class="px-4 py-3">
          <div class="product-img-wrapper rounded-3 bg-light d-flex align-items-center justify-content-center" style="width: 65px; height: 65px;">
            <img src="${product.imagen}" alt="${
      product.nombre
    }" class="product-thumbnail rounded-3 shadow-sm" style="max-width: 60px; max-height: 60px; object-fit: cover;">
          </div>
        </td>
        <td class="px-4 py-3 fw-medium text-dark">${product.nombre}</td>
        <td class="px-4 py-3"><span class="badge bg-light text-dark rounded-pill px-3 py-2">${
          product.categoria
        }</span></td>
        <td class="px-4 py-3 fw-medium">${Number(product.precio).toFixed(
          2
        )}€</td>
        <td class="px-4 py-3">
          ${
            product.stock == 0
              ? `<span class="badge bg-danger text-white px-3 py-2 rounded-pill"><i class="bi bi-x-circle-fill me-1"></i> 0</span>`
              : product.stock <= 5
              ? `<span class="badge bg-warning text-dark px-3 py-2 rounded-pill"><i class="bi bi-exclamation-triangle-fill me-1"></i> ${product.stock}</span>`
              : `<span class="badge bg-light text-dark px-3 py-2 rounded-pill">${product.stock}</span>`
          }
        </td>
        <td class="px-4 py-3">
          <span class="badge ${estadoBadgeClass} rounded-pill px-3 py-2">
            ${estadoIcon}${estadoText}
          </span>
        </td>
        <td class="px-4 py-3 text-center">
          <div class="btn-group" role="group" aria-label="Acciones de producto">
            <button class="btn btn-sm btn-outline-primary edit-product me-2 rounded-pill" title="Editar producto" data-product-id="${
              product.id_producto
            }" aria-label="Editar producto">
              <i class="bi bi-pencil"></i> Editar
            </button>
            <button class="btn btn-sm btn-outline-danger delete-product rounded-pill" title="Eliminar producto" data-product-id="${
              product.id_producto
            }" data-product-name="${
      product.nombre
    }" aria-label="Eliminar producto">
              <i class="bi bi-trash"></i> Eliminar
            </button>
          </div>
        </td>
      `;
    productsTableBody.appendChild(row);
  });
  assignActionHandlers();
}

function renderPagination(currentPage, totalPages) {
  paginationContainer.innerHTML = "";
  if (totalPages <= 1) return;
  let html = `<nav aria-label="Navegación de páginas de productos"><ul class="pagination pagination-md justify-content-center mb-0">`;
  html += `<li class="page-item ${
    currentPage <= 1 ? "disabled" : ""
  }"><a class="page-link rounded-start" href="#" data-page="${
    currentPage - 1
  }" aria-label="Anterior"><span aria-hidden="true"><i class="bi bi-chevron-left"></i></span></a></li>`;
  let startPage = Math.max(1, currentPage - 2);
  let endPage = Math.min(startPage + 4, totalPages);
  if (startPage > 1) {
    html += `<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>`;
    if (startPage > 2) {
      html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
    }
  }
  for (let i = startPage; i <= endPage; i++) {
    html += `<li class="page-item ${
      i === currentPage ? "active" : ""
    }"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
  }
  if (endPage < totalPages) {
    if (endPage < totalPages - 1) {
      html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
    }
    html += `<li class="page-item"><a class="page-link" href="#" data-page="${totalPages}">${totalPages}</a></li>`;
  }
  html += `<li class="page-item ${
    currentPage >= totalPages ? "disabled" : ""
  }"><a class="page-link rounded-end" href="#" data-page="${
    currentPage + 1
  }" aria-label="Siguiente"><span aria-hidden="true"><i class="bi bi-chevron-right"></i></span></a></li>`;
  html += `</ul></nav>`;
  paginationContainer.innerHTML = html;
  paginationContainer.querySelectorAll("a.page-link").forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const page = parseInt(this.getAttribute("data-page"));
      if (!isNaN(page) && page !== currentPage) {
        currentPage = page;
        fetchAndRenderProducts(page);
      }
    });
  });
}

function assignActionHandlers() {
  document.querySelectorAll(".edit-product").forEach((button) => {
    button.addEventListener("click", function () {
      const productId = this.dataset.productId;
      loadProductData(productId);
    });
  });
  document.querySelectorAll(".delete-product").forEach((button) => {
    button.addEventListener("click", function () {
      const productId = this.dataset.productId;
      confirmDelete(productId);
    });
  });
}

async function initializeProductManagement() {
  await loadCategories();

  document.getElementById("productStatus").value = "1";

  const addProductForm = document.getElementById("addProductForm");
  const saveProductBtn = document.getElementById("saveProduct");

  saveProductBtn.addEventListener("click", function () {
    if (addProductForm.checkValidity()) {
      const formData = new FormData(addProductForm);

      Swal.fire({
        title: "Guardando producto",
        text: "Por favor espere...",
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        },
      });

      fetch("/addProduct", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            Swal.fire({
              title: "¡Éxito!",
              text: "Producto guardado correctamente",
              icon: "success",
              iconColor: "#aa0303",
              confirmButtonColor: "#aa0303",
            }).then(() => {
              window.location.reload();
            });
          } else {
            Swal.fire({
              title: "Error",
              text: data.message || "Error al guardar el producto",
              icon: "error",
              confirmButtonColor: "#aa0303",
            });
          }
        })
        .catch((error) => {
          Swal.fire({
            title: "Error",
            text: "Error al procesar la solicitud",
            icon: "error",
            confirmButtonColor: "#aa0303",
          });
        });
    } else {
      addProductForm.reportValidity();
    }
  });

  const editButtons = document.querySelectorAll(".edit-product");
  editButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const productId = this.dataset.productId;
      loadProductData(productId);
    });
  });

  const deleteButtons = document.querySelectorAll(".delete-product");
  deleteButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const productId = this.dataset.productId;
      confirmDelete(productId);
    });
  });

  const updateProductBtn = document.getElementById("updateProduct");
  const editProductForm = document.getElementById("editProductForm");

  updateProductBtn.addEventListener("click", function () {
    if (editProductForm.checkValidity()) {
      const formData = new FormData(editProductForm);
      const estadoValue = document.querySelector(
        'input[name="estado"]:checked'
      );
      if (estadoValue) {
        formData.set("estado", estadoValue.value);
      }

      Swal.fire({
        title: "Actualizando producto",
        text: "Por favor espere...",
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        },
      });

      fetch("/updateProduct", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            Swal.fire({
              title: "¡Éxito!",
              text: "Producto actualizado correctamente",
              icon: "success",
              iconColor: "#aa0303",
              confirmButtonColor: "#aa0303",
            }).then(() => {
              window.location.reload();
            });
          } else {
            Swal.fire({
              title: "Error",
              text: data.error || "Error al actualizar el producto",
              icon: "error",
              confirmButtonColor: "#aa0303",
            });
          }
        })
        .catch((error) => {
          console.error("Error al actualizar el producto:", error);
          Swal.fire({
            title: "Error",
            text: "Error al procesar la solicitud",
            icon: "error",
            confirmButtonColor: "#aa0303",
          });
        });
    } else {
      editProductForm.reportValidity();
    }
  });
}

async function loadCategories(selectedId = null, forEdit = false) {
  try {
    const response = await fetch("/getCategories");
    const categories = await response.json();
    const addCategorySelect = document.getElementById("productCategory");
    const editCategorySelect = document.getElementById("editProductCategory");
    if (!forEdit) {
      addCategorySelect.innerHTML =
        '<option value="">Seleccionar categoría</option>';
      categories.forEach((category) => {
        addCategorySelect.add(
          new Option(category.nombre, category.id_categoria)
        );
      });
    } else {
      editCategorySelect.innerHTML =
        '<option value="">Seleccionar categoría</option>';
      categories.forEach((category) => {
        const option = new Option(category.nombre, category.id_categoria);
        if (selectedId && category.id_categoria == selectedId) {
          option.selected = true;
        }
        editCategorySelect.add(option);
      });
    }
  } catch (error) {
    console.error("Error loading categories:", error);
  }
}

function loadProductData(productId) {
  fetch(`/getProduct?id=${productId}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Error en la respuesta del servidor");
      }
      return response.json();
    })
    .then((product) => {
      document.getElementById("editProductId").value = product.id_producto;
      document.getElementById("editProductName").value = product.nombre;
      document.getElementById("editProductPrice").value = product.precio;
      document.getElementById("editProductDiscount").value =
        product.descuento || 0;
      document.getElementById("editProductStock").value = product.stock;
      document.getElementById("editProductDescription").value =
        product.descripcion;
      document.getElementById("editProductDetails").value =
        product.detalles_producto || "";
      document.getElementById("editProductStatusActive").checked =
        product.estado === "activo";
      document.getElementById("editProductStatusInactive").checked =
        product.estado === "inactivo";
      document.getElementById("editProductStatusOutOfStock").checked =
        product.estado === "agotado";
      loadCategories(product.id_categoria, true);
      document.getElementById("editProductImage").value = "";
      const editModal = new bootstrap.Modal(
        document.getElementById("editProductModal")
      );
      editModal.show();
    })
    .catch((error) => {
      console.error("Error al cargar el producto:", error);
      Swal.fire({
        title: "Error",
        text: "Error al cargar los datos del producto",
        icon: "error",
      });
    });
}

function confirmDelete(productId) {
  Swal.fire({
    title: "¿Estás seguro?",
    text: "Esta acción no se puede deshacer",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#dc3545",
    cancelButtonColor: "#6c757d",
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      deleteProduct(productId);
    }
  });
}

function deleteProduct(productId) {
  Swal.fire({
    title: "Eliminando producto",
    text: "Por favor espere...",
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    },
  });

  fetch(`/deleteProduct?id=${productId}`, {
    method: "POST",
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Error en la respuesta del servidor");
      }
      return response.json();
    })
    .then((data) => {
      if (data.success) {
        Swal.fire({
          title: "¡Éxito!",
          text: "Producto eliminado correctamente",
          icon: "success",
          iconColor: "#aa0303",
          confirmButtonColor: "#aa0303",
        }).then(() => {
          window.location.reload();
        });
      } else {
        Swal.fire({
          title: "Error",
          text: data.message || "Error al eliminar el producto",
          icon: "error",
          confirmButtonColor: "#aa0303",
        });
      }
    })
    .catch((error) => {
      console.error("Error al eliminar el producto:", error);
      Swal.fire({
        title: "Error",
        text: "Error al procesar la solicitud",
        icon: "error",
        confirmButtonColor: "#aa0303",
      });
    });
}

async function main() {
  await fetchAndRenderProducts();
  await initializeProductManagement();
}

main().catch(console.error);

const editProductModalEl = document.getElementById("editProductModal");
if (editProductModalEl) {
  editProductModalEl.addEventListener("hidden.bs.modal", function () {
    document.body.classList.remove("modal-open");
    document.body.style.overflow = "";
    document.body.style.paddingRight = "";
    const backdrops = document.querySelectorAll(".modal-backdrop");
    backdrops.forEach((backdrop) => backdrop.remove());
  });
}

document.querySelectorAll(".modal").forEach((modal) => {
  modal.addEventListener("hidden.bs.modal", function () {
    document.body.classList.remove("modal-open");
    document.body.style.overflow = "";
    document.body.style.paddingRight = "";
    const backdrops = document.querySelectorAll(".modal-backdrop");
    backdrops.forEach((backdrop) => backdrop.remove());
  });
});
