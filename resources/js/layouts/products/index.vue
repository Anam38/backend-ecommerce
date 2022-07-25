<template>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card card position-relative">
          <div class="card-body">
            <div style="margin-bottom:10px">
              <h4 class="card-title">Product list</h4>
              <router-link class="btn btn-sm btn-primary bg-primary" to="/products/store">
               <i class="mdi mdi-add"></i> Tambah Data
             </router-link>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Weight</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Create</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="items in getdata" :key="items.id">
                    <td>{{ items.id }}</td>
                    <td>{{ items.name }}</td>
                    <td>{{ items.category_name }}</td>
                    <td>{{ items.weight }}</td>
                    <td>{{ items.stock }}</td>
                    <td>{{ items.price }}</td>
                    <td>{{ items.updated_at }}</td>
                    <td>
                      <div class="">
                        <router-link :to="{ name: 'productUpdate', params: { id: items.id }}" class="btn btn-sm btn-info btn-icon-text" title="more info">
                          <i class="mdi mdi-account-card-details"></i>
                        </router-link>
                        <button @click="modalDelete(items)" class="btn btn-sm btn-danger btn-icon-text" title="delete data">
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
      <!-- modal delete -->
      <modal-component modal_title="Delete Product" v-show="showModalDelete" @close-modal="showModalDelete = false" @modal-post="destroy(deletedata.id)">
        <div class="">
          <p>Are you sure to delete "{{ deletedata.name }}"? You cannot restore a deleted Product.</p>
        </div>
      </modal-component>
      <!-- modal delete -->
  </div>
</template>

<script>
    export default {
      mounted() {
           console.log('product load');
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
            axios.get(location.origin + '/api/products', {
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
         },

         modalDelete( items ){
           this.showModalDelete = true;
           this.deletedata = items;
         },

         destroy: function(id){
           axios.post(location.origin + '/api/products/destroy/' + id, this.deletedata)
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
                $('#dataTable').DataTable();
            })
        }
      }
    }
</script>
