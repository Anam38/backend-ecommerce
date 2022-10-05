<template>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card card position-relative">
          <div class="card-body">
            <div style="margin-bottom:10px">
              <h4 class="card-title">User list</h4>
              <router-link class="btn btn-sm btn-primary bg-primary" to="/users/store">
               <i class="mdi mdi-add"></i> Tambah Data
             </router-link>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="userTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Create</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="items in getdata" :key="items.id">
                    <td>{{ items.id }}</td>
                    <td>{{ items.name }}</td>
                    <td>{{ items.email }}</td>
                    <td>{{ items.updated_at }}</td>
                    <td>
                      <div class="">
                        <router-link :to="{ name: 'usersUpdate', params: { id: items.id }}" class="btn btn-sm btn-warning btn-icon-text" title="edit data">
                          <i class="mdi mdi-pencil"></i>
                        </router-link>
                        <button @click="openModal(items.id)" class="btn btn-sm btn-danger btn-icon-text" title="delete data">
                          <i class="mdi mdi-delete-forever"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
    export default {
      mounted() {
           console.log('users load');
      },
      data(){
        return {
          notification: {},
          getdata : {},
        }
      },
      created() {
          this.getData();  //load data users
      },
       methods: {
          getData() {
            axios.get(location.origin + '/admin/users', {
                // params: this.tableProps
            })
            .then(response => {
                this.getdata = response.data.data;
                this.reloadTable();
            })
            // eslint-disable-next-line
            .catch(errors => {
              console.log(errors);
                //Handle Errors
            })
         },

         openModal: function(id) {
           const apps = this // important
           notification({
             status: "warning",
             timeout: false,
             close: false,
             msg: "Are You Sure Delete this Data !",
             button : [
                  ['<button>Delete</button>', function (instance, toast) {
                    instance.hide({
                        transitionOut: 'fadeOutUp',
                        onClosing: function(instance, toast, closedBy){
                            console.info('closedBy: ' + closedBy); // The return will be: 'closedBy: buttonName'
                        }
                    }, toast, 'buttonName');
                    // action
                    apps.destroy( id ) //Delete data parse to controller

                  }, true], // true to focus
                  ['<button>Cancel</button>', function (instance, toast) {
                      instance.hide({
                          transitionOut: 'fadeOutUp',
                          onClosing: function(instance, toast, closedBy){
                              console.info('closedBy: ' + closedBy); // The return will be: 'closedBy: buttonName'
                          }
                      }, toast, 'buttonName');
                  }]
              ],
           })
         },

         destroy: function(id){
           axios.get(location.origin + '/admin/users/destroy/' + id)
               .then(response => {
                 if (response.data.success) {
                   this.notification = {status : 'success', message : 'delete data success.'}
                   // load data
                   this.getData();
                 }else {
                   this.notification = {status : 'warning', message : 'delete data failed.'}
                 }

                   notification({
                     status: this.notification.status,
                     timeout: 3000,
                     close: false,
                     msg: this.notification.message
                   });
           });
         },
         reloadTable() {
            // this.getData();
            $(document).ready( function() {
                $('#userTable').DataTable();
            })
        }
      }
    }
</script>
