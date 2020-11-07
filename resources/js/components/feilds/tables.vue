<template>

  <div class="container">
    <div class="row justify-content-center">

      <div class="col-md-12">
        <div class="card border-default">
          <div class="card-header">
            <h2 class="center">
                <button
                class="btn float-left btn-primary mb-1"
                type="button"
            @click="reloadTable"
              > <i class="fas fa-redo-alt"></i> Reload </button>
              Feilds
              <button
                class="btn float-right btn-primary mb-1"
                type="button"   
            @click="openModal"
              >Add Feilds</button>
            </h2>
          </div>

          <div class="card-body">
            <div
              class="modal fade"
              id="addArea"
              tabindex="-1"
              role="dialog"
              aria-labelledby="myModalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Add Feilds</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body" >
                                 <error-Page :error="error"></error-Page>
<form data-vv-scope="feild">
                    <div class="form-group row" >
                      <label class="col-md-3 col-form-label" for="name">Name *</label>
                      <div class="col-md-9">
                        <input
                          class="form-control"
                          v-validate="'required'"
                          
                          type="text"
                          name="name"
                          placeholder="Enter name"
                          v-model="feild.name"
                        />
                        <span class="help-block"></span>
                        <span
                          v-show=" errors.has('feild.name') "
                          class="invalid"
                        >{{ errors.first('feild.name') }}</span>
                      </div>
                    </div>
                      <div class="form-group row">
                     
                      <label class="col-md-3 col-form-label" for="type">Type</label>
                      <div class="col-md-9">
                       <select name="type" v-model="feild.type" id="">
                           <option value="text">Text</option>
                                                      <option value="text_area">Text Area</option>
   <option value="text_area_advanced">Text Area (Advanced)</option>
      
                           <option value="radio">Radio Button</option>
                           <option value="checkbox">checkbox</option>
                                                      <option value="select">select</option>
                           <option value="select_multiple">select (Multiple)</option>
                                                      <option value="date">Date  Picker </option>

                           <option value="date_time">Date Time Picker </option>
                           <!-- <option value="file">File </option> -->


                       </select>
                       <br>
                        <span class="help-block"> For Select And Radio Buttons ,Options  can be added  while editing</span>
                        <span
                          v-show=" errors.has('type') "
                          class="invalid"
                        >{{ errors.first('type') }}</span>
                      </div>
                    </div> 
                     <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="checkbox">Is Required</label>
                                            <div class="col-md-9">

                     <input type="checkbox" id="checkbox" name="checkbox" v-model="feild.is_required">

                        <span class="help-block"></span>
                        <span
                          v-show=" errors.has('is_required') "
                          class="invalid"
                        >{{ errors.first('is_required') }}</span>
                      </div>
                    </div>
                    <h5 class="mb-0">
                      <div  v-if="isUpdate=='true'">
                          <button class="btn btn-link"  style="color:white" type="button" @click="catToFeildOpen">
 + Link Categories
  </button>

  </div>
                    </h5>
                      <h5 class="mb-0">
                      <div  v-if="isUpdate=='true'">
                          <button class="btn btn-link" v-if=" feild.type=='radio' || feild.type== 'select' || feild.type=='select_multiple'" style="color:white" type="button" @click="openOptionModal">
 + Add  Options
  </button>

  </div>
                    </h5>

                                        <h5 class="mb-0">

       <button class="btn btn-link" style="color:white" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
 + Open Advance Options
  </button>

                    </h5>     
<div class="collapse" id="collapseExample">

                      <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="help">Help Text</label>
                      <div class="col-md-9">
                        <input
                          class="form-control"
                          
                          type="text"
                          name="help"
                          v-validate="''"
                          placeholder="Enter help Text"
                          v-model="feild.help"
                        />
                        <span class="help-block"></span>
                        <span
                          v-show=" errors.has('help') "
                          class="invalid"
                        >{{ errors.first('help') }}</span>
                      </div>
                    </div>
                      <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="default">Default Value</label>
                      <div class="col-md-9">
                        <input
                          class="form-control"
                          v-validate="''"
                          
                          type="text"
                          name="default"
                          placeholder="Enter Deafult value"
                          v-model="feild.default"
                          autocomplete="name"
                        />
                        <span class="help-block"></span>
                        <span
                          v-show=" errors.has('name') "
                          class="invalid"
                        >{{ errors.first('name') }}</span>
                      </div>
                    </div>
                      <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="name">Min Value</label>
                      <div class="col-md-9">
                        <input
                          class="form-control"
                          v-validate="''"
                          
                          type="text"
                          placeholder="Enter Min Value"
                          v-model="feild.min"
                          autocomplete="name"
                        />
                        <span class="help-block"></span>
                        <span
                          v-show=" errors.has('min') "
                          class="invalid"
                        >{{ errors.first('min') }}</span>
                      </div>
                    </div>
                      <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="name">Max Value</label>
                      <div class="col-md-9">
                        <input
                          class="form-control"
                          v-validate="''"
                          
                          type="text"
                          name="name"
                          placeholder="Enter Maximum value"
                          v-model="feild.max"
                          autocomplete="name"
                        />
                        <span class="help-block"></span>
                        <span
                          v-show=" errors.has('max') "
                          class="invalid"
                        >{{ errors.first('max') }}</span>
                      </div>
                    </div>
            </div>
</form>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" :disabled="feild.busy" type="button" @click="postdata" >{{(isUpdate?"Update":"Create")}}</button>
                  </div>
                 
                </div>
                <!-- /.modal-content-->
              </div>
              <!-- /.modal-dialog-->
            </div>
            
                      <div
              class="modal fade modal-success"
              id="addOptionModal"
              tabindex="-1"
              role="dialog"
              aria-labelledby="myModalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Add Options </h4>

                  </div>
                  <div class="modal-body" data-vv-scope="options">
                    <form  data--vv--scope="options">
                       <div class="form-group row" >
                      <label class="col-md-3 col-form-label" for="value">Name *</label>
                      <div class="col-md-9">
                        <input
                          class="form-control"
                          v-validate="'required'"
                          
                          type="text"
                          name="value"
                          placeholder="Enter name"
                          v-model="feildOptions.value"
                        />
                        <span class="help-block"></span>
                        <span
                          v-show=" errors.has('options.value') "
                          class="invalid"
                        >{{ errors.first('options.value') }}</span>
                      </div>
                    </div>
                    </form>
                      
                  </div>
                  <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" @click="closeOptionmodal"  >Close</button>
                    <button class="btn btn-primary" :disabled="options.busy" type="button" @click="postOptions" >{{(isUpdate2?"Update":"Create")}}</button>
                 
              
                  </div>
                                         <div class="container" >

                        <data-table
                                 ref="optionsReload"

    :columns="columns2"
    :order-dir="desc"
    v-bind:url="url2"

    >

</data-table>
                                         </div>
                </div>
              </div>
            
              </div>
                     <div
              class="modal fade modal-success"
              id="catToFeildModal"
              tabindex="-1"
              role="dialog"
              aria-labelledby="myModalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Add Category  To Feilds</h4>

                  </div>
                  <div class="modal-body" data-vv-scope="options">
                    <form  >
                       <div class="form-group row" >
                      <label class="col-md-3 col-form-label" for="value">Add Category *</label>
                      <div class="col-md-9">
                     <model-select :options="catOptions"
                                v-model="catToFeild.category_id"
                                placeholder="select item">
         </model-select>
                      </div>
                    </div>
                    </form>
                    <div   v-if="isUpdate=='true'">
                       <data-table
                                 ref="categoriesReload"

    :columns="columns3"
    :order-dir="desc"
    v-bind:url="categoriesUrl"

    >
  

</data-table>
                    </div>
                  </div>
                  <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" @click="catToFeildClose"  >Close</button>
                    <button class="btn btn-primary" :disabled="catToFeild.busy" type="button" @click="addCategoryToFeild" >Add</button>
                 
              
                  </div>
                                         <div class="container" >

                     
                                         </div>
                </div>
              </div>
            
              </div>
             <data-table
                                 ref="reloadingTheTable"

    :columns="columns"
    :order-dir="desc"
    v-bind:url="url"
    @loading="isLoading = true"
            @finished-loading="isLoading = false"
    >

</data-table>
 <loading 
            :active.sync="isLoading"
            :can-cancel="true"
            :loader="bars"
            :opacity='transparent'
            :is-full-page="false">
        </loading>  
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    import { ModelSelect } from 'vue-search-select'

 import editButton from '../dashboard/includes/edit';
 import deleteButton  from '../dashboard/includes/delete';
 import errorPage  from '../dashboard/includes/errors';


export default {
  data() {
    return {
      bars:"bars",
      error:null,
      url:process.env.MIX_APP_URL+'/feilds/',

                      isUpdate:false,
                                            isUpdate2:false,

                                      isLoading: false,

desc:"desc",
categoriesUrl:process.env.MIX_APP_URL+'/feilds/categories/' + this.feild_id,
transparent:0.1,
catOptions:[],
catToFeild:new Form({
  category_id:'',
  feild_id:''


}

),
 filters: {
            cat_id: '',
            load:'true',
        },  
              columns: [
                {
                    label: 'ID',
                    name: 'id',
                    orderable: true,
                },
                {
                    label: 'Name',
                    name: 'name',
                    orderable: true,
                      event: "click",
                },
                 {
                    label: 'Type',
                    name: 'type',
                    orderable: true,
                      event: "click",
                },
                {
                     label: 'Required',
                    name: 'required',
                    orderable: false,
                      event: "click",
                },
             
             
                 {
                label: '',
                name: 'Edit',
                orderable: false,
                classes: { 
                    'btn': true,
                    'btn-primary': true,
                    'btn-sm': true,
                },
                width:1,
                event: "click",
                handler: this.edit,
                component: editButton, 
                
            },
            {
                label: '',
                name: 'Delete',
                filterable: false,
                component: deleteButton,
                event: "click",
                handler: this.remove,
                width:1,
                classes: { 
                    'btn': true,
                    'btn-danger': true,
                    'btn-sm': true,
                } 
            }
            ],
              columns2: [
                {
                    label: 'ID',
                    name: 'id',
                    orderable: true,
                },
             
               {
                    label: 'Name',
                    name: 'value',
                    orderable: true,
                      event: "click",
                },
                 {
                label: '',
                name: 'Edit',
                orderable: false,
                classes: { 
                    'btn': true,
                    'btn-primary': true,
                    'btn-sm': true,
                },
                width:1,
                event: "click",
                handler: this.editOptions,
                component: editButton, 
                
            },
            {
                label: '',
                name: 'Delete',
                filterable: false,
                component: deleteButton,
                event: "click",
                handler: this.deleteOptions,
                width:1,
                classes: { 
                    'btn': true,
                    'btn-danger': true,
                    'btn-sm': true,
                } 
            }
            ],
                columns3: [
                {
                    label: 'ID',
                    name: 'id',
                    orderable: true,
                },
             
               {
                    label: 'Name',
                    name: 'cat_name',
                    orderable: true,
                      event: "click",
                },
              
            {
                label: '',
                name: 'Delete',
                filterable: false,
                component: deleteButton,
                event: "click",
                handler: this.deleteCategories,
                width:1,
                classes: { 
                    'btn': true,
                    'btn-danger': true,
                    'btn-sm': true,
                } 
            }
            ],
options: [],
feild_id:"",
feildOptions:new Form({
  feild_id:"",
value:"",
}),
url2:process.env.MIX_APP_URL+'/feilds/options/' + this.feild_id,
feild: new Form({
        name: "",
        type:"text",
        default:"",
        help:"",
        max:"",
        min:"",
        is_required:""

      }),
    };
  },
  created() {
         this.getoptions();


  },
 
    components: {
            ModelSelect,
            editButton,
            deleteButton,  
            'error-Page':errorPage ,


    },
  methods: {
    editOptions(data){
      this.feildOptions.fill(data);
      this.feildOptions.feild_id=data.feild_id;

this.isUpdate2="true";
this.options_id=data.id;

    },
     getoptions(){
           axios.get("/dashboard/category/options").then((res) => {
       this.catOptions=res.data;
      });

      },
     edit(data){
             $("#addArea").modal("show");
this.isUpdate="true";
this.feild.fill(data);
this.feild_id=data.id;
this.feildOptions.feild_id=data.id;
            this.catToFeild.feild_id=data.id;

         this.url2=process.env.MIX_APP_URL+'/feilds/options/' +this.feild_id;
this.getdata2();
this.categoriesUrl=process.env.MIX_APP_URL+'/feilds/categories/' +this.feild_id;


  },
  remove(data){
    if(confirm('are you sure?'))
        axios.delete('/feilds/'+data.id)
          .then(res => {
            this.getdata();
                              this.$toastr.success(res.data, "Success");

        })
          .catch(error => {
              this.$toastr.error("Something went wrong", "Error");
        })

  },
   deleteOptions(data){
    if(confirm('are you sure?'))
        axios.delete('/feilds/removeOptions/'+data.id)
          .then(res => {
                           this.$refs.optionsReload.getData();
                              this.$toastr.success(res.data, "Success");

        })
          .catch(error => {
              this.$toastr.error("Something went wrong", "Error");
        })

  },
  deleteCategories(data){
if(confirm('are you sure?'))
        axios.delete('/feilds/removeCategories/'+data.id)
          .then(res => {
                                      this.$refs.categoriesReload.getData();


                              this.$toastr.success(res.data, "Success");

        })
          .catch(error => {
              this.$toastr.error("Something went wrong", "Error");
        })

  },
  
  reloadTable() {
        this.getdata();

            },
    
    getdata() {
                       this.$refs.reloadingTheTable.getData()

    },
     getdata2() {
                           this.$refs.optionsReload.getData()

    },

    openModal(){

         $("#addArea").modal("show");
                  this.feild.reset();

         this.isUpdate=false;

    },
    openOptionModal(){
               $("#addOptionModal").modal("show");
  
    },
  
    postdata() {
      this.$validator.validateAll('feild').then((result) => {
        if (result) {
            var url = "";
      if (this.isUpdate) {
        url = this.feild.put("/feilds/"+ this.feild_id);
      } else {
        url =           this.feild.post("/feilds");
      }
           url .then((res) => {
              if (res.status == 200) {

                this.$toastr.success(res.data, "Success");
                this.getdata();

                    this.feild.reset();
        this.$validator.reset();

   $("#addArea").modal("hide");
   this.isUpdate=false;
              }
            })
            .catch(e => {
              this.error=e.response.data;
              this.$toastr.error("Something went wrong", "Error");
            });
        }
      });
    },
    closeOptionmodal(){
                           $("#addOptionModal").modal("hide");

    },
    catToFeildOpen(){
                           $("#catToFeildModal").modal("show");

    },
      catToFeildClose(){
                           $("#catToFeildModal").modal("hide");

    },
    addCategoryToFeild(){
      
  this.catToFeild.post('feilds/addCategory') .then((res) => {
              if (res.status == 200) {
                                       this.$refs.categoriesReload.getData()

                this.$toastr.success(res.data, "Success");

                    this.catToFeild.category_id="";

              }
            })
            .catch(e => {
              this.error=e.response.data;
                           $("#catToFeildModal").modal("hide");

              this.$toastr.error("Something went wrong", "Error");
            });
        
     
    },
    
  
    postOptions() {
      this.$validator.validateAll('options').then((result) => {
        if (result) {
            var url = "";
      if (this.isUpdate2) {
        url = this.feildOptions.put("/feilds/editOptions/"+ this.options_id);
      } else {
        url =           this.feildOptions.post("/feilds/addOptions");
      }
           url .then((res) => {
              if (res.status == 200) {

                this.$toastr.success(res.data, "Success");

                    this.feildOptions.value="";
        this.$validator.reset();
                       this.$refs.optionsReload.getData();

   this.isUpdate2=false;
              }
            })
            .catch(e => {
              this.error=e.response.data;
                           $("#addOptionModal").modal("hide");

              this.$toastr.error("Something went wrong", "Error");
            });
        }
      });
    },
  
  },
  
 }
 
</script>
