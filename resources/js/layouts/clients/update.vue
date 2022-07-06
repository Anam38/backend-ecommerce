<template>
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Client Info</h4>
        <form class="forms-sample" @submit.prevent="update">
          <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputName1">Name</label>
              <input type="text" class="form-control disable_update" v-model="updatedata.username" disabled>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail3">Email address</label>
              <input type="email" class="form-control disable_update" v-model="updatedata.email" disabled>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail3">Phone Number</label>
              <input type="number" class="form-control disable_update" v-model="updatedata.phone_number" disabled>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword4">New Password</label>
              <input type="password" class="form-control disable_update" placeholder="New password" v-model="updatedata.new_password" disabled>
            </div>
          </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6">
              <label for="exampleInputEmail3">Date Of Birth</label>
              <div class="">
                <date-picker v-model="updatedata.date_of_birth" color="indigo"
                  :min-date="new Date('01-01-1990')"
                  :max-date="new Date()"
                  :masks="masks"
                  :model-config="modelConfig" is-required>
                  <template v-slot="{ inputValue, inputEvents }">
                    <input
                      class="form-control disable_update"
                      :value="inputValue"
                      v-on="inputEvents"
                      disabled
                    />
                  </template>
                </date-picker>
              </div>
            </div>
            <div class="col-sm-6 row">
              <label for="exampleInputEmail3">Gender</label>
              <div class="row">
              <div class="col-sm-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input disable_update" name="membershipRadios" id="membershipRadios1" value="m" v-model="updatedata.gender" disabled>
                    Male
                  <i class="input-helper"></i></label>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input disable_update" name="membershipRadios" id="membershipRadios2" value="f" v-model="updatedata.gender" disabled>
                    Female
                  <i class="input-helper"></i></label>
                </div>
              </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div style="display: flow-root;">
              <label for="exampleInputPassword4">Address</label>
              <button style="float:right;margin-bottom:5px;" type="button" class="btn btn-sm btn-primary bg-primary" @click="showModalAdd = true">
               <i class="mdi mdi-add"></i> Add new Address
             </button>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="clientTableUpdate">
                <thead>
                  <tr>
                    <th>Label</th>
                    <th>Receiver</th>
                    <th>Phone</th>
                    <th>Pos</th>
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(items, index) in addresslists" :key="items.id">
                    <td>{{ items.receiver_label }}</td>
                    <td>{{ items.receiver }}</td>
                    <td>{{ items.phone_number }}</td>
                    <td>{{ items.pos_code }}</td>
                    <td>{{ items.address }}, {{ items.city }}</td>
                    <td>
                      <div class="">
                        <button type="button" class="btn btn-sm btn-warning btn-icon-text" title="more info" @click="addressupdate(items, index)">
                          <i class="ti-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger btn-icon-text" title="delete data" @click="addressdelete(items, index)">
                          <i class="ti-trash"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <button type="button" class="btn btn-primary mr-2" @click="disableEdit">{{ btn_submit }}</button>
          <router-link to="/client" class="btn btn-light">Cancel</router-link>
        </form>
      </div>
    </div>
  </div>
  <!-- modal add address -->
    <modal-component modal_title="Add Address" v-show="showModalAdd" @close-modal="showModalAdd = false" @modal-post="update">
      <div class="form-group">
        <label for="exampleInputName1">Label Penerima</label>
        <input type="text" class="form-control" v-model="addressdata.receiver_label">
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="exampleInputName1">Penerima</label>
            <input type="text" class="form-control" v-model="addressdata.receiver">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="exampleInputEmail3">Phone Number</label>
            <input type="number" class="form-control" v-model="addressdata.phone_number">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8">
          <div class="form-group">
            <label for="exampleInputName1">Kota atau Kecamatan</label>
            <input type="text" class="form-control" v-model="addressdata.city">
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="exampleInputEmail3">Kode Pos</label>
            <input type="number" class="form-control" v-model="addressdata.pos_code">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="exampleInputName1">Alamat</label>
        <input type="text" class="form-control" v-model="addressdata.address">
      </div>
    </modal-component>
    <!-- modal add address -->
  <!-- modal update address -->
    <modal-component modal_title="Update Address" v-show="showModalUpdate" @close-modal="showModalUpdate = false" @modal-post="update">
      <div class="form-group">
        <label for="exampleInputName1">Label Penerima</label>
        <input type="text" class="form-control" v-model="updatedataaddress.receiver_label">
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="exampleInputName1">Penerima</label>
            <input type="text" class="form-control" v-model="updatedataaddress.receiver">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="exampleInputEmail3">Phone Number</label>
            <input type="number" class="form-control" v-model="updatedataaddress.phone_number">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8">
          <div class="form-group">
            <label for="exampleInputName1">Kota atau Kecamatan</label>
            <input type="text" class="form-control" v-model="updatedataaddress.city">
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="exampleInputEmail3">Kode Pos</label>
            <input type="number" class="form-control" v-model="updatedataaddress.pos_code">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="exampleInputName1">Alamat</label>
        <input type="text" class="form-control" v-model="updatedataaddress.address">
      </div>
    </modal-component>
    <!-- modal update address -->
    <!-- modal delete address -->
    <modal-component modal_title="Delete Address" v-show="showModalDelete" @close-modal="showModalDelete = false" @modal-post="addressdestroy">
      <div class="">
        <p>Are you sure to delete "{{ deleteaddresstitle }}"? You cannot restore a deleted address.</p>
      </div>
    </modal-component>
    <!-- modal delete address -->
  </div>
</template>

<script>
    export default {
      mounted() {
          console.log('client update get');
      },
      data(){
        return {
          showModalAdd: false,
          showModalUpdate: false,
          showModalDelete: false,
          btn_submit: 'Edit',
          notification : {},
          addressdata : {},
          addresslists : {},
          updatedata : {},
          updatedataaddress : {},
          deletedataaddress : {},
          deleteaddresstitle : '',
          modelConfig: {
            type: 'string',
            mask: 'DD-MM-YYYY', // Uses 'iso' if missing
          },
          masks: {
            input: 'DD-MM-YYYY',
          },
        }
      },
      created() {
          axios.get(location.origin + '/api/clients/update/' + this.$route.params.id)
              .then(response => {
                  this.updatedata = response.data.data[0];
                  this.addresslists = this.updatedata.address ? JSON.parse(this.updatedata.address) : Array();

                  this.getdatatables()
          });
      },
      methods: {
          disableEdit(event){
              if (event.target.submit == true) {
                event.target.type = 'submit';
              }
              event.target.submit = true;
              this.btn_submit = 'Submit';
              $(document).find('.disable_update').removeAttr('disabled');
          },

          addressupdate( data, id ){
            this.showModalUpdate = true;
            this.updatedataaddress = data
            this.updatedataaddress.id = id
          },

          addressupdatepost() {
            this.addresslists[this.updatedataaddress.id] = this.updatedataaddress;
          },

          addressdelete( data, id ){
            this.showModalDelete = true;
            this.deleteaddresstitle = data.receiver_label;
            this.deletedataaddress = data;
            this.deletedataaddress.id = id
          },

          update() {

              if (typeof this.updatedataaddress.id !== 'undefined'){
                this.addresslists[this.updatedataaddress.id] = this.updatedataaddress;
                this.updatedata.address = this.addresslists;
              }

              if(Object.keys(this.addressdata).length != 0){
                this.addresslists.push(this.addressdata);
                this.updatedata.address = this.addresslists;
              }

              axios.post(location.origin + '/api/clients/update', this.updatedata)
                  .then((response) => {

                    this.showModalAdd = false;
                    this.showModalUpdate = false;

                    if (response.data.success) {
                      this.notification = {status : 'success', message : 'update data success.'}

                      // redirect to list user page
                      this.$router.push({ path: '/client/update/'+ this.$route.params.id});

                    }else if(!response.data.success) {
                      this.notification = {status : 'warning', message : response.data.message}
                    }

                    notification({
                      status: this.notification.status,
                      timeout: 3000,
                      close: false,
                      msg: this.notification.message
                    });

              })
              .catch(error => {
                if (error.response.data.message = 'the given data was invalid') {
                  for (var items in error.response.data.errors) {
                    notification({
                      status: "warning",
                      timeout: 3000,
                      close: false,
                      msg: "Inputan " + items + " tidak boleh kosong"
                    })
                  }

                }
                  console.log(error)
              })
              .finally(() => this.loading = false);
          },

          addressdestroy() {

            const indexOfObject = this.addresslists.findIndex(object => {
              return object.id === this.deletedataaddress.id;
            });

            this.addresslists.splice(indexOfObject, 1);
            this.updatedata.address = this.addresslists;

            axios.post(location.origin + '/api/clients/update', this.updatedata)
                .then((response) => {

                  this.showModalDelete = false;

                  if (response.data.success) {
                    this.notification = {status : 'success', message : 'delete address success.'}

                    // redirect to list user page
                    this.$router.push({ path: '/client/update/'+ this.$route.params.id});

                  }else if(!response.data.success) {
                    this.notification = {status : 'warning', message : response.data.message}
                  }

                  notification({
                    status: this.notification.status,
                    timeout: 3000,
                    close: false,
                    msg: this.notification.message
                  });

            })
            .catch(error => {console.log('delete address' + error)})
          },

          getdatatables(){
            $(document).ready( function() {
                $('#clientTableUpdate').DataTable({
                  "bLengthChange": false,
                  "searching": false,
                });
            })
          }
      }
    }
</script>
