<template>
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">form Add Product</h4>
        <form class="forms-sample">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputName1">Name</label>
                <input type="text" class="form-control" placeholder="Name Product" v-model="storedata.name">
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Category Master</label>
                <Select2 v-model="storedata.category_code_master" :options="categoriesdataMaster" @select="getCategoryChild($event)" placeholder="select categories"/>
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Category</label>
                <Select2 v-model="storedata.category_code_child" :options="categoriesdataChild" placeholder="Choose Category master first"/>
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Size <code>* Optional</code></label>
                <vue-tags-input
                  v-model="storedata.size"
                  placeholder="Add Size"
                  :tags="sizeTags"
                  @tags-changed="newTags => sizeTags = newTags"
                />
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Variant <code>* Optional</code></label>
                <vue-tags-input
                  v-model="storedata.variant"
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
                          <input type="radio" class="form-check-input" name="is_popular" value="1" v-model="storedata.is_popular">
                          Yes
                        <i class="input-helper"></i></label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="is_popular" value="0" v-model="storedata.is_popular" checked="checked">
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
                  <input type="number" class="form-control" placeholder="Weight by gram" v-model="storedata.weight" />
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Gram</button>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Stock</label>
                <div class="input-group col-xs-12">
                  <input type="number" class="form-control" placeholder="Stock product" v-model="storedata.stock"/>
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">PCS</button>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Price</label>
                <div class="input-group col-xs-12">
                  <input type="number" class="form-control" placeholder="price product per Item" v-model="storedata.price" />
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">RP</button>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Discount <code>*Optional</code></label>
                <div class="input-group col-xs-12">
                  <input type="number" class="form-control" placeholder="Discount per Item" v-model="storedata.discount" />
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">%</button>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label for="img">File upload <code>*required. Max size 2,5MB, and should be Img</code></label>
                <input type="file" name="img" id="upload" @change="getFile" ref="file" class="file-upload-default">
                <div class="input-group col-xs-12 tags-input-with-button">
                  <vue-tags-input
                    v-model="storedata.img"
                    placeholder="Add image"
                    :tags="imgTags"
                    @tags-changed="newTags => imgTags = newTags"
                    @before-deleting-tag="imgDeleteTags"
                  />
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" @click="openFile" type="button">choose</button>
                  </span>
                </div>
              </div>
              <div class="form-group row">
                  <label for="exampleInputEmail3">New</label>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="is_new" value="1" v-model="storedata.is_new">
                          Yes
                        <i class="input-helper"></i></label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="is_new" value="0" v-model="storedata.is_new" checked="checked">
                          No
                        <i class="input-helper"></i></label>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label for="">Description</label>
              <vue-editor v-model="storedata.description" />
            </div>
          </div>
          <button type="button" @click="store" class="btn btn-primary mr-2">Submit</button>
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
          sizeTags: [],
          variantTags: [],
          imgTags: [],
          storedata : {},
          categoriesdataMaster : [],
          categoriesdataChild : [],
          imgFiles : [],
        }
      },
      created() {
        // get category
        this.category();
      },
      methods: {
            openFile(){
                var link = document.getElementById('upload');
                link.click()
            },

            getFile(event){
              var files = this.$refs.file.files[0];

              this.imgFiles.push(files);
              this.imgTags.push({'text':files.name});
            },

            imgDeleteTags(event){
              var index = event.tag.text;
              const indexOfObject = this.imgFiles.findIndex(object => {
                return object.name === index;
              });
              this.imgFiles.splice(indexOfObject, 1);
              event.deleteTag()
            },

            category() {
              axios.get(location.origin + '/api/product-categories')
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
              axios.get(location.origin + '/api/product-child-categories/findbycode/' + event.id)
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

            store() {
                // input to model
                this.ModelInput(
                  this.TagsParseValue(this.sizeTags), //parse data
                  this.TagsParseValue(this.variantTags),
                  this.imgFiles
                );

                // parse to formData
                const formData = this.parseData(this.storedata);

                axios.post(location.origin + '/api/products/store', formData)
                    .then((response) => {
                      if (response.data.success) {

                        notification({
                            status: "success",
                            timeout: 3000,
                            close: false,
                            msg: "Add data success."
                        });

                        this.$router.push({name: 'productLoad'});
                      }
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

            ModelInput(size, variant, img){
              this.storedata.sizes = size;
              this.storedata.variants = variant;
              this.storedata.imgs = img;
            },

            TagsParseValue(Tags) {
              return Tags.map( foo  => foo.text);
            },

            parseData(data){
              const formData = new FormData();
              for (let key in data) {
                  Array.isArray(data[key])
                      ? data[key].forEach(value => formData.append(key + '[]', value))
                      : formData.append(key, data[key]) ;
              }
              return formData;
            }
        }
    }
</script>
