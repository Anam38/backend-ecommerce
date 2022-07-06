<template>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card card position-relative">
          <div class="card-body">
            <div style="margin-bottom:10px">
              <h4 class="card-title">Client list</h4>
              <router-link class="btn btn-sm btn-primary bg-primary" to="/client/store">
               <i class="mdi mdi-add"></i> Tambah Data
             </router-link>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="clientTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>phone</th>
                    <th>Birth</th>
                    <th>gender</th>
                    <th>Create</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="items in getdata" :key="items.id">
                    <td>{{ items.id }}</td>
                    <td>{{ items.username }}</td>
                    <td>{{ items.email }}</td>
                    <td>{{ items.phone_number }}</td>
                    <td>{{ items.date_of_birth }}</td>
                    <td v-if="items.gender == 'm'">Male</td>
                    <td v-else>Female</td>
                    <td>{{ items.updated_at }}</td>
                    <td>
                      <div class="">
                        <router-link :to="{ name: 'clientUpdate', params: { id: items.id }}" class="btn btn-sm btn-info btn-icon-text" title="more info">
                          <i class="ti-eye"></i>
                        </router-link>
                        <button @click="modalDelete(items)" class="btn btn-sm btn-danger btn-icon-text" title="delete data">
                          <i class="ti-trash"></i>
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
      <!-- modal delete -->
      <modal-component modal_title="Delete Client" v-show="showModalDelete" @close-modal="showModalDelete = false" @modal-post="destroy(deletedata.id)">
        <div class="">
          <p>Are you sure to delete "{{ deletedata.username }}"? You cannot restore a deleted address.</p>
        </div>
      </modal-component>
      <!-- modal delete -->
  </div>
</template>

<script>
    export default {
      mounted() {
           console.log('users load');
      },
      data(){
        return {
          showModalDelete: false,
          notification: {},
          getdata : {},
          deletedata : {},
        }
      },
      created() {
          this.getData();  //load data users
      },
       methods: {
          getData() {
            axios.get(location.origin + '/api/clients', {
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

         modalDelete( items ){
           this.showModalDelete = true;
           this.deletedata = items;
         },

         destroy: function(id){
           axios.get(location.origin + '/api/clients/destroy/' + id)
               .then(response => {
                 this.showModalDelete = false;

                 if (response.data.success) {
                   this.notification = {status : 'success', message : 'delete data success.'}
                   // load data
                   this.getData()
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
            $(document).ready( function() {
                $('#clientTable').DataTable();
            })
        }
      }
    }
</script>
