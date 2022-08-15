// const SERVER_URL = 'http://localhost:8888';
var app = new Vue({
  el: '#app',
  data: {
    errorMsg: "",
    successMsg: "",
    showAddModal: false,
    showEditModal: false,
    showDeleteModal: false,
    users: [],
    newUser: {name: "",email: ""},
    currentUser: {}
  },
  mounted: function() {
    this.getAllUsers();
  },
  methods: {
    getAllUsers() {
      axios.get("http://127.0.0.1:8888/process.php?action=read").then(function(response){
        if(response.data.error){
          app.errorMsg = response.data.message;
        } else {
          app.users = response.data.users;
        }
      });
    },
    addUser(){
      var formData = app.toFormData(app.newUser);
      axios.post("http://127.0.0.1:8888/process.php?action=create", formData).then(function(response){
        app.newUser = {name: "",email: ""};
        if(response.data.error){
          app.errorMsg = response.data.message;
        } else {
          app.successMsg = response.data.message;
          app.getAllUsers();
        }
      });
    },
    updateUser(){
      var formData = app.toFormData(app.currentUser);
      axios.post("http://127.0.0.1:8888/process.php?action=update", formData).then(function(response){
        app.currentUser = {};
        if(response.data.error){
          app.errorMsg = response.data.message;
        } else {
          app.successMsg = response.data.message;
          app.getAllUsers();
        }
      });
    },
    deleteUser(){
      var formData = app.toFormData(app.currentUser);
      axios.post("http://127.0.0.1:8888/process.php?action=delete", formData).then(function(response){
        app.currentUser = {};
        if(response.data.error){
          app.errorMsg = response.data.message;
        } else {
          app.successMsg = response.data.message;
          app.getAllUsers();
        }
      });
    },
    toFormData(obj){
      var fd = new FormData();
      for(var i in obj){
        fd.append(i, obj[i]);
      }
      return fd;
    },
    selectUser(user){
      app.currentUser = user;
    },
    clearMsg(){
      app.errorMsg = "";
      app.successMsg = "";
    }
  }
});