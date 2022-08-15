<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Site</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <style>
    #overlay {
      position: fixed;
      top:0;
      bottom: 0;
      left: 0;
      right: 0;
      background: rgba(0, 0, 0, 0.5);

    }
  </style>
</head>
<body>
  <div id="app">
    <div class="container-fluid">
      <div class="row bg-dark">
        <div class="col-lg-12">
          <p class="text-center text-light display-5 pt-2">Aplicação CRUD com PHP, Vuejs e MySQL</p>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-3">
        <div class="col-lg-6">
          <h3 class="text-info">Registros</h3>
        </div>
        <div class="col-lg-6">
          <button class="btn btn-info float-right" @click="showAddModal=true">
            <i class="bi bi-person-circle"></i>&nbsp;&nbsp;Novo usuário
          </button>
        </div>
      </div>
      <hr class="bg-info">
      <div class="alert alert-danger" v-if="errorMsg">
        {{ errorMsg }}
      </div>
      <div class="alert alert-success" v-if="successMsg">
        {{ successMsg }}
      </div>
      <!-- Registros -->
      <div class="row">
        <div class="col-lg-12">
          <table class="table table-bordered table-striped align-middle">
            <thead>
              <tr class="text-center bg-info text-light">
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Editar</th>
                <th>Deletar</th>
              </tr>
            </thead>
            <tbody>

              <tr class="text-center" v-for="user in users">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>
                  <button class="btn btn-success" @click="showEditModal=true; selectUser(user);">
                    <i class="bi bi-pencil"></i>
                  </button>
                </td>
                <td>
                  <button class="btn btn-danger" @click="showDeleteModal=true; selectUser(user);">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal Adicionar novo usuario -->
    <div id="overlay" v-if="showAddModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Adicionar usuario</h5>
            <button type="button" class="close" @click="showAddModal=false">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p4">
            <form action="" method="POST">
              <div class="form-group mb-3">
                <input type="text" name="name" class="form-control form-control-lg" placeholder="Digite seu nome" v-model="newUser.name">
              </div>
              <div class="form-group mb-3">
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Digite seu email" v-model="newUser.email">
              </div>
              <div class="form-group">
                <button class="btn btn-primary btn-block btn-lg" @click="showAddModal=false; addUser(); clearMsg();">
                  Adicionar usuário
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div><!-- Fim Modal Adicionar novo usuario -->

    <!-- Modal atualizar usuario -->
    <div id="overlay" v-if="showEditModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Atualizar usuario</h5>
            <button type="button" class="close" @click="showEditModal=false">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p4">
            <form action="" method="POST">
              <div class="form-group mb-3">
                <input type="text" name="name" class="form-control form-control-lg" v-model="currentUser.name">
              </div>
              <div class="form-group mb-3">
                <input type="email" name="email" class="form-control form-control-lg" v-model="currentUser.email">
              </div>
              <div class="form-group">
                <button class="btn btn-primary btn-block btn-lg" @click="showEditModal=false; updateUser(); clearMsg();">
                  Atualizar usuário
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div><!-- Fim Model Atualizar usuario -->

    <!-- Modal atualizar usuario -->
    <div id="overlay" v-if="showDeleteModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Deletar usuario?</h5>
            <button type="button" class="close" @click="showDeleteModal=false">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <div class="modal-body p4">
              
                <div class="alert alert-info">
                  <strong>Atenção</strong>
                  <p>Gostaria de deletar o usuário <strong>{{ currentUser.name }}</strong> ?</p>
                </div>
              
              
                <button class="btn btn-danger btn-lg" @click="showDeleteModal=false; deleteUser(); clearMsg();">
                  Sim
                </button>
              
                <button class="btn btn-primary btn-lg" @click="showDeleteModal=false">
                  Não
                </button>      
          </div>
        </div>
      </div>
    </div><!-- Fim Modal Delete usuario -->

  </div>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js"></script>
  <script src="./main.js"></script>
</body>
</html>
