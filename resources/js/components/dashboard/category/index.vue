<template>

  <div class="container">
    <div class="row justify-content-center">

      <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header">
            <h2 class="center">
                <button
                class="btn float-left btn-primary mb-1"
                type="button"
            @click="reloadTable"
              > <i class="fas fa-redo-alt"></i> Reload </button>
              Category
              <button
                class="btn float-right btn-primary mb-1"
                type="button"
            @click="openModal"
              >Add Category</button>
            </h2>
          </div>

          <div class="card-body">
            <div
              class="modal fade"
              id="addCategory"
              tabindex="-1"
              role="dialog"
              aria-labelledby="myModalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Add category</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
 
                  </div>
                  <div class="modal-body">
                                       
             <error-Page :error="error"></error-Page>

                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="name">Name</label>
                      <div class="col-md-9">
                        <input
                          class="form-control"
                          v-validate="'required'"
                          id="name"
                          type="text"
                          name="name"
                          placeholder="Enter name"
                          v-model="category.name"
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
                      <label class="col-md-3 col-form-label" for="icon">Fav Icon</label>
                      <div class="col-md-9">
                        <input
                          class="form-control"
                          v-validate=""
                          id="icon"
                          type="text"
                          name="icon"
                          placeholder="Enter Icon Name"
                          v-model="category.icon"
                          autocomplete="icon"
                        />
                        <span class="help-block">
                          Example :
                           &lt; i class="i fa-settings" &gt;  &lt; /i &gt;
                        </span>
                        <span
                          v-show=" errors.has('icon') "
                          class="invalid"
                        >{{ errors.first('icon') }}</span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="parent_id">Select Main category</label>
                      <div class="col-md-9">
                         <model-select :options="options"
                                v-model="category.parent_id"
                                placeholder="select item">
         </model-select>
                      
                        <span class="help-block">
                        Leave Blank For Main category
                        </span>
                        <span
                          v-show=" errors.has('icon') "
                          class="invalid"
                        >{{ errors.first('icon') }}</span>
                      </div>
                    </div>
                   
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" :disabled="category.busy" type="button" @click="postdata" >{{(isUpdate?"Update":"Create")}}</button>
                  </div>
                </div>
                <!-- /.modal-content-->
              </div>
              <!-- /.modal-dialog-->
            </div>
             <data-table
                                 ref="reloadingTheTable"

    :columns="columns"
    :filters="filters"
    :order-dir="desc"
    v-bind:url="url"
    @loading="isLoading = true"
            @finished-loading="isLoading = false"
    >
    <div slot="filters" slot-scope="{ tableData, perPage }">
        <div class="row mb-2">
            <div class="col-md-4">
                <select class="form-control" v-model="tableData.length">
                    <option class="option" :key="page" v-for="page in perPage">{{ page }}</option>
                </select>
            </div>
            <div class="col-md-4">
                <model-select :options="options"
                                v-model="tableData.filters.cat_id"
                                placeholder="select Category">
         </model-select>
            </div>
            <div class="col-md-4">
                <input
                    name="name"
                    class="form-control"
                    v-model="tableData.search"
                    placeholder="Search Table">
            </div>
        </div>
    </div>
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

 import editButton from '../includes/edit';
 import deleteButton  from '../includes/delete';
 import errorPage  from '../includes/errors';


export default {
  data() {
    return {
      bars:"bars",
      error:null,
      url:process.env.MIX_APP_URL+'/dashboard/category/',
                      isUpdate:false,
                      category_id:"",
                                      isLoading: false,

desc:"desc",
transparent:0.1,
 filters: {
            cat_id: '',
            load:'true',
        },        columns: [
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
                handler: this.edit,
                },
                {
                    label: 'Parent',
                    name: 'parent_name',
                    orderable: false,
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
options: [],
      category: new Form({
        name: "",
        icon: "",
        parent_id: "",
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
     edit(data){
             $("#addCategory").modal("show");
this.isUpdate=true;
this.category.fill(data);
this.category_id=data.id;
  },
  remove(data){
    

  },
  subCategory(data){
tableData.filters.cat_id=data.parent_id;
  },
  reloadTable() {
    // this.filters.reset();
        this.getdata();

                // this.$refs.reloadingTheTable.getData()
            },
      getoptions(){
           axios.get("/dashboard/category/options").then((res) => {
       this.options=res.data;
      });

      },
    getdata() {
                       this.$refs.reloadingTheTable.getData()

    },
    openModal(){

         $("#addCategory").modal("show");
                  this.category.reset();

         this.isUpdate=false;

    },
    postdata() {
      this.$validator.validateAll().then((result) => {
        if (result) {
            var url = "";
      if (this.isUpdate) {
        url = this.category.put("/dashboard/category/" + this.category_id);
      } else {
        url =           this.category.post("/dashboard/category");
      }
           url .then((res) => {
              if (res.status == 200) {

                this.$toastr.success(res.data, "Success");
                this.getdata();
                                          this.getoptions();
        this.$validator.reset();

                    this.category.reset();
   $("#addCategory").modal("hide");
   this.isUpdate=false;
              }
            })
            .catch(e => {
              this.error=e.response.data.errors;
              this.$toastr.error("Something went wrong", "Error");
            });
        }
      });
    },
  },
   mounted(){

  }
 
 
}
</script>
