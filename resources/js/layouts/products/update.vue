<template>
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Info Product</h4>
        <form class="forms-sample">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputName1">Name</label>
                <input type="text" class="form-control" placeholder="Name Product" v-model="updatedata.name">
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Category Master</label>
                <Select2 v-model="updatedata.category_code_master" :options="categoriesdataMaster" @select="getCategoryChild($event)" placeholder="select categories"/>
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Category</label>
                <Select2 v-model="updatedata.category_code_child" :options="categoriesdataChild" placeholder="select categories"/>
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Size <code>* Optional</code></label>
                <vue-tags-input
                  v-model="updatedata.sizeUpdate"
                  placeholder="Add Size"
                  :tags="sizeTags"
                  @tags-changed="newTags => sizeTags = newTags"
                />
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Variant <code>* Optional</code></label>
                <vue-tags-input
                  v-model="updatedata.variantUpdate"
                  placeholder="Add variant"
                  :tags="variantTags"
                  @tags-changed="newTags => variantTags = newTags"
                />
              </div>
              <div class="form-group row">
                  <label for="exampleInputEmail3">Popular</label>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="is_popular" value="1" v-model="updatedata.is_popular">
                          Yes
                        <i class="input-helper"></i></label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="is_popular" value="0" v-model="updatedata.is_popular" checked="checked">
                          No
                        <i class="input-helper"></i></label>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputName1">Weight</label>
                <div class="input-group col-xs-12">
                  <input type="number" class="form-control" placeholder="Weight by gram" v-model="updatedata.weight" />
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Gram</button>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Stock</label>
                <div class="input-group col-xs-12">
                  <input type="number" class="form-control" placeholder="Stock product" v-model="updatedata.stock"/>
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">PCS</button>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Price</label>
                <div class="input-group col-xs-12">
                  <input type="number" class="form-control" placeholder="price product per Item" v-model="updatedata.price" />
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">RP</button>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Discount <code>*Optional</code></label>
                <div class="input-group col-xs-12">
                  <input type="number" class="form-control" placeholder="Discount per Item" v-model="updatedata.discount" />
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">%</button>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label for="img">File upload <code>*required. Max size 2,5MB, and should be Img</code></label>
                <div class="col-xs-12">
                  <input type="file" name="img" id="upload" @change="getFile" ref="file" class="file-upload-default">
                  <button class="file-upload-browse btn btn-primary" @click="openFile" type="button">Add image</button>
                </div>
              </div>
              <div class="form-group row">
                  <label for="exampleInputEmail3">New</label>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="is_new" value="1" v-model="updatedata.is_new">
                          Yes
                        <i class="input-helper"></i></label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="is_new" value="0" v-model="updatedata.is_new" checked="checked">
                          No
                        <i class="input-helper"></i></label>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="row" id="imgshow">
            <div class="form-group">
              <label for="">List images Product</label>
            </div>
              <div class="col-sm-3" v-for="(items, index) in oldImg" style="padding:2.5px;">
                <div class="card card-custome">
                  <div class="card-body">
                    <img width="100%" :src="items" alt="">
                    <div class="dock-card" @click="imgDelete(items)" >
                        Delete
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div id="imgshow"></div> -->
          </div>
          <div class="row">
            <div class="form-group">
              <label for="">Description</label>
              <vue-editor v-model="updatedata.description" />
            </div>
          </div>
          <button type="button" @click="update" class="btn btn-primary mr-2">Submit</button>
          <router-link to="/products" class="btn btn-light">Cancel</router-link>
        </form>
      </div>
    </div>
  </div>
  </div>
</template>
<script>
    import VueTagsInput from '@johmun/vue-tags-input';
    import { VueEditor } from "vue2-editor";
    import Select2 from 'v-select2-component';

    export default {
      components: {
        VueTagsInput,
        VueEditor,
        Select2
      },
      mounted() {
         console.log('product add');
      },
      data(){
        return {
          updatedata : {},
          sizeTags: [],
          variantTags: [],
          categoriesdataMaster : [],
          categoriesdataChild : [],
          imgFiles : [],
          oldImg: [],
          deleteImg: [],
          notification : {},
        }
      },
      created() {
        this.getData();
      },
      methods: {
            openFile(){
                var link = document.getElementById('upload');
                link.click()
            },

            getFile(event){
              var files = this.$refs.file.files[0];
              this.imgFiles.push(files);
              this.readImage(files)
            },

            getData() {
              axios.get(location.origin + '/admin/products/find/' + this.$route.params.id)
              .then(response => {
                  this.updatedata = response.data.data;
                  this.sizeTags = this.TagsStucturGenerate(JSON.parse(this.updatedata.size));
                  this.variantTags = this.TagsStucturGenerate(JSON.parse(this.updatedata.variant));
                  this.oldImg = this.parseImg(JSON.parse(response.data.data.img));


                  this.category();
                  this.getCategoryChild( { id : response.data.data.category_code_master } );
              })
              .catch(errors => {
                console.log(errors);
              })
           },

            category() {
              axios.get(location.origin + '/admin/product-categories')
              .then(response => {

                // regenerate data structur
                  const arrayObj = response.data.data.map(item => {
                      return {
                        id: item.code,
                        text: item.name
                      };
                    });

                  this.categoriesdataMaster = arrayObj;
              })
              .catch(errors => {
                console.log(errors);
              })
            },

            getCategoryChild(event) {
              axios.get(location.origin + '/admin/product-child-categories/findbycode/' + event.id)
              .then(response => {

                // regenerate data structur
                  const arrayObj = response.data.data.map(item => {
                      return {
                        id: item.code,
                        text: item.name
                      };
                    });

                  this.categoriesdataChild = arrayObj;
              })
              .catch(errors => {
                console.log(errors);
              })
            },

            update(){
              // validation new img
              this.newImgValidation('.newimgadded');
              // input to model
              this.ModelInput(
                this.TagsParseValue(this.sizeTags), //parse data
                this.TagsParseValue(this.variantTags),
                this.imgFiles,
                this.UnParseImg(this.oldImg)
              );
              // parse to formData
              const formData = this.parseData(this.updatedata);
              axios.post(location.origin + '/admin/products/update', formData)
                  .then((response) => {
                    if (response.data.success) {
                        this.notification = {status : 'success', message : 'update data success.'}

                        // redirect to list user page
                        this.$router.push({name: 'productLoad'});

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
                console.log(error.response)
              })
              .finally(() => this.loading = false);
            },

            newImgValidation(className){
              var elm = document.querySelectorAll(className);
              var dataArray = [];

              var data = Array.prototype.forEach.call(elm, function (items) {
                dataArray.push(items.getAttribute('name'));
              });
              this.NewimgDelete(dataArray);
            },

            NewimgDelete(items){
              if (items.length) {
                items.map((item,index) => {
                  var difference = this.imgFiles.filter(x => !items.includes(x.name));
                  if (difference.length) {
                    const indexOfObject = this.imgFiles.findIndex(object => {
                      return object.name === difference[index].name;
                    });
                    this.imgFiles.splice(indexOfObject, 1);
                  }
                });
              }else {
                this.imgFiles = [];
              }
            },

            imgDelete(items){
              const indexOfObject = this.oldImg.findIndex(object => {
                return object === items;
              });
              this.deleteImg.push(items.split(location.origin)[1]);
              this.oldImg.splice(indexOfObject, 1);
              this.updatedata.delete_img = this.deleteImg;
            },

            ModelInput(size, variant, img_new, old_img){
              this.updatedata.sizes = size;
              this.updatedata.variants = variant;
              this.updatedata.new_img = img_new;
              this.updatedata.old_img = old_img;
            },

            TagsParseValue(Tags) {
              return Tags.map( foo  => foo.text);
            },

            TagsStucturGenerate(Tags) {
              if (Tags) {
                return Tags.map( foo  => {
                  return {
                    text : foo
                  }
                });
              }else {
                return [];
              }
            },

            parseData(data){
              const formData = new FormData();
              for (let key in data) {
                  Array.isArray(data[key])
                      ? data[key].forEach(value => formData.append(key + '[]', value))
                      : formData.append(key, data[key]) ;
              }
              return formData;
            },

            parseImg(data){
              const newImg = data.map((items, index) => {
                return (items) ? location.origin + '/' + items : null;;
              });

              return newImg;
            },

            UnParseImg(data){
              const newImg = data.map((items, index) => {
                return (items) ? items.split(location.origin)[1] : null;;
              });

              return newImg;
            },

            readImage(file) {
              // Check if the file is an image.
              if (file.type && !file.type.startsWith('image/')) {
                console.log('File is not an image.', file.type, file);
                notification({
                    status: "warning",
                    timeout: 3000,
                    close: false,
                    msg: "ile is not an image. " + file.type
                });
              }

              const reader = new FileReader();
              var img = '';
              reader.addEventListener('load', (event) => {
                var cardImg = '<div class="col-sm-3" style="padding:2.5px;" id="'+ file.name +'">'+
                '<div class="card card-custome">'+
                '<div class="card-body">'+
                '<img width="100%" src="'+ event.target.result +'" alt="">'+
                '<div class="dock-card newimgadded" name="'+ file.name +'"'+
                  'onclick=document.getElementById("'+ file.name +'").remove();>Delete</div>'+
                '</div>'+
                '</div>'+
                '</div>';
                document.getElementById('imgshow').insertAdjacentHTML("beforeend", cardImg);
              });
              reader.readAsDataURL(file);
            }
        }
    }
</script>
