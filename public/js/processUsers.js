document.addEventListener("DOMContentLoaded", function () {
  const usersTable = document.getElementById("usersTable");
  const usersSkeleton = document.getElementById("usersSkeleton");
  const usersTableBody = document.getElementById("usersTableBody");
  const usersCountSkeleton = document.getElementById("usersCountSkeleton");
  const usersCountReal = document.getElementById("usersCountReal");
  const totalUsers = document.getElementById("totalUsers");
  const noUsersMessage = document.getElementById("noUsersMessage");
  const paginationContainer = document.getElementById("paginationContainer");
  const paginationInfo = document.getElementById("paginationInfo");

  const editUserModal = new bootstrap.Modal(
    document.getElementById("editUserModal")
  );
  const deleteConfirmModal = new bootstrap.Modal(
    document.getElementById("deleteConfirmModal")
  );

  const editUserForm = document.getElementById("editUserForm");

  const updateUserBtn = document.getElementById("updateUser");
  const confirmDeleteBtn = document.getElementById("confirmDelete");

  let currentPage = 1;
  let totalPages = 1;
  let userToDelete = null;

  loadUsers(currentPage);

  updateUserBtn.addEventListener("click", handleUpdateUser);
  confirmDeleteBtn.addEventListener("click", handleDeleteUser);

  async function loadUsers(page) {
    try {
      const response = await fetch(`/getUsers?page=${page}`);
      const data = await response.json();

      if (response.ok) {
        displayUsers(data);
      } else {
        showError("Error al cargar los usuarios");
      }
    } catch (error) {
      showError("Error al cargar los usuarios");
    }
  }

  function displayUsers(data) {
    usersSkeleton.classList.add("d-none");
    usersTable.classList.remove("d-none");
    usersCountSkeleton.classList.add("d-none");
    usersCountReal.classList.remove("d-none");

    totalUsers.textContent = data.totalUsers;

    usersTableBody.innerHTML = "";

    if (data.users.length === 0) {
      noUsersMessage.classList.remove("d-none");
      return;
    }

    noUsersMessage.classList.add("d-none");

    data.users.forEach((user) => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td class="px-4 py-3">${user.id_usuario}</td>
        <td class="px-4 py-3">${user.nombre} ${user.apellido}</td>
        <td class="px-4 py-3">${user.correo}</td>
        <td class="px-4 py-3">
          <span class="badge ${getUserTypeBadgeClass(user.tipo_usuario)}">
            ${user.tipo_usuario}
          </span>
        </td>
        <td class="px-4 py-3">
          <span class="badge ${user.estado ? "bg-success" : "bg-danger"}">
            ${user.estado ? "Activo" : "Inactivo"}
          </span>
        </td>
        <td class="px-4 py-3 text-center">
          <div class="btn-group" role="group" aria-label="Acciones de usuario">
            <button class="btn btn-sm btn-outline-primary edit-user me-2 rounded-pill" title="Editar usuario" data-user-id="${
              user.id_usuario
            }" aria-label="Editar usuario">
              <i class="bi bi-pencil"></i> Editar
            </button>
            <button class="btn btn-sm btn-outline-danger delete-user rounded-pill" title="Eliminar usuario" data-user-id="${
              user.id_usuario
            }" data-user-name="${user.nombre} ${
        user.apellido
      }" aria-label="Eliminar usuario">
              <i class="bi bi-trash"></i> Eliminar
            </button>
          </div>
        </td>
      `;
      usersTableBody.appendChild(row);
    });

    currentPage = data.currentPage;
    totalPages = data.totalPages;
    updatePagination(data);

    assignActionHandlers();
  }

  function updatePagination(data) {
    paginationContainer.innerHTML = "";
    if (data.totalPages <= 1) return;

    let html = `<nav aria-label="Navegación de páginas de usuarios"><ul class="pagination pagination-md justify-content-center mb-0">`;
    html += `<li class="page-item ${
      currentPage <= 1 ? "disabled" : ""
    }"><a class="page-link rounded-start" href="#" data-page="${
      currentPage - 1
    }" aria-label="Anterior"><span aria-hidden="true"><i class="bi bi-chevron-left"></i></span></a></li>`;

    let startPage = Math.max(1, currentPage - 2);
    let endPage = Math.min(startPage + 4, data.totalPages);

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

    if (endPage < data.totalPages) {
      if (endPage < data.totalPages - 1) {
        html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
      }
      html += `<li class="page-item"><a class="page-link" href="#" data-page="${data.totalPages}">${data.totalPages}</a></li>`;
    }

    html += `<li class="page-item ${
      currentPage >= data.totalPages ? "disabled" : ""
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
          loadUsers(page);
        }
      });
    });

    paginationInfo.textContent = `Mostrando ${data.startIndex + 1} a ${
      data.endIndex
    } de ${data.totalUsers} usuarios`;
  }

  function getUserTypeBadgeClass(type) {
    switch (type) {
      case "Administrador":
        return "bg-danger";
      case "Premium":
        return "bg-warning text-dark";
      default:
        return "bg-primary";
    }
  }

  function assignActionHandlers() {
    document.querySelectorAll(".edit-user").forEach((button) => {
      button.addEventListener("click", function () {
        const userId = this.dataset.userId;
        editUser(userId);
      });
    });

    document.querySelectorAll(".delete-user").forEach((button) => {
      button.addEventListener("click", function () {
        const userId = this.dataset.userId;
        const userName = this.dataset.userName;
        deleteUser(userId, userName);
      });
    });
  }

  async function editUser(userId) {
    try {
      const response = await fetch(`/getUser?id=${userId}`);
      const user = await response.json();

      if (response.ok) {
        document.getElementById("editUserId").value = user.id_usuario;
        document.getElementById("editUserName").value = user.nombre;
        document.getElementById("editUserLastName").value = user.apellido;
        document.getElementById("editUserEmail").value = user.correo;
        document.getElementById("editUserPhone").value = user.telefono;
        document.getElementById("editUserType").value = user.tipo_usuario;
        document.getElementById("editUserBirthDate").value =
          user.fecha_nacimiento;
        document.getElementById("editUserGender").value = user.genero;
        document.getElementById("editUserWeight").value = user.peso || "";
        document.getElementById("editUserHeight").value = user.altura || "";
        const preview = document.getElementById("editUserPhotoPreview");
        if (user.foto_perfil) {
          preview.src = user.foto_perfil;
          preview.style.display = "block";
          document.getElementById("editUserPhotoActual").value =
            user.foto_perfil;
        } else {
          preview.src = "";
          preview.style.display = "none";
          document.getElementById("editUserPhotoActual").value = "";
        }
        if (user.estado) {
          document.getElementById("editUserStatusActive").checked = true;
        } else {
          document.getElementById("editUserStatusInactive").checked = true;
        }
        editUserModal.show();
      } else {
        showError("Error al cargar los datos del usuario");
      }
    } catch (error) {
      showError("Error al cargar los datos del usuario");
    }
  }

  const editUserPhotoInput = document.getElementById("editUserPhoto");
  if (editUserPhotoInput) {
    editUserPhotoInput.addEventListener("change", function (e) {
      const preview = document.getElementById("editUserPhotoPreview");
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (ev) {
          preview.src = ev.target.result;
          preview.style.display = "block";
        };
        reader.readAsDataURL(file);
      } else {
        preview.src = "";
        preview.style.display = "none";
      }
    });
  }

  async function handleUpdateUser() {
    if (!editUserForm.checkValidity()) {
      editUserForm.classList.add("was-validated");
      return;
    }

    try {
      const formData = new FormData(editUserForm);
      const response = await fetch("/updateUser", {
        method: "POST",
        body: formData,
      });

      const data = await response.json();

      if (response.ok) {
        editUserModal.hide();
        showSuccess("Usuario actualizado correctamente");
        loadUsers(currentPage);
      } else {
        showError(data.error || "Error al actualizar el usuario");
      }
    } catch (error) {
      showError("Error al actualizar el usuario");
    }
  }

  function deleteUser(userId, userName) {
    userToDelete = userId;
    document.getElementById("userToDeleteName").textContent = userName;
    deleteConfirmModal.show();
  }

  async function handleDeleteUser() {
    if (!userToDelete) return;

    try {
      const formData = new FormData();
      formData.append("id", userToDelete);

      const response = await fetch("/deleteUser", {
        method: "POST",
        body: formData,
      });
      const data = await response.json();

      if (response.ok) {
        deleteConfirmModal.hide();
        showSuccess("Usuario eliminado correctamente");
        loadUsers(currentPage);
      } else {
        showError(data.error || "Error al eliminar el usuario");
      }
    } catch (error) {
      showError("Error al eliminar el usuario");
    } finally {
      userToDelete = null;
    }
  }

  function showError(message) {
    Swal.fire({
      title: "Error",
      text: message,
      icon: "error",
      confirmButtonColor: "#aa0303",
    });
  }

  function showSuccess(message) {
    Swal.fire({
      title: "¡Éxito!",
      text: message,
      icon: "success",
      iconColor: "#aa0303",
      confirmButtonColor: "#aa0303",
    });
  }
});

const editUserModalEl = document.getElementById("editUserModal");
if (editUserModalEl) {
  editUserModalEl.addEventListener("hidden.bs.modal", function () {
    document.body.classList.remove("modal-open");
    document.querySelectorAll(".modal-backdrop").forEach((el) => el.remove());
  });
}
