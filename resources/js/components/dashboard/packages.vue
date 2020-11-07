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
              <button
                class="btn float-right btn-primary mb-1"
                type="button"
            @click="openModal"
              >Add packages</button>
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
                    <h4 class="modal-title">Add package</h4>
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
                          type="text"
                          placeholder="Enter name"
                          v-model="package.name"
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
                      <label class="col-md-3 col-form-label" for="name">Price</label>
                      <div class="col-md-9">
                        <input
                          class="form-control"
                          v-validate="'required'"
                          type="number"
                          placeholder="Enter price"
                          v-model="package.price"
                        />
                        <span class="help-block">In Rps</span>
                        <span
                          v-show=" errors.has('price') "
                          class="invalid"
                        >{{ errors.first('price') }}</span>
                      </div>
                    </div>
                     <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="name">Time</label>
                      <div class="col-md-9">
                        <input
                          class="form-control"
                          v-validate="'required'"
                          type="number"
                          name="days"
                          placeholder="Enter days"
                          v-model="package.days"
                        />
                        <span class="help-block">In Days.EG : 30</span>
                        <span
                          v-show=" errors.has('days') "
                          class="invalid"
                        >{{ errors.first('days') }}</span>
                      </div>
                    </div>


                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="icon">Description</label>
                      <div class="col-md-9">
                        <textarea
                          class="form-control"
                          v-validate="''"
                      
                          placeholder="Enter description"
                          v-model="package.description"
                        ></textarea>
                        <span class="help-block">
                         </span>
                        <span
                          v-show=" errors.has('description') "
                          class="invalid"
                        >{{ errors.first('description') }}</span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="parent_id">Select  package</label>
                      <div class="col-md-9">
                 <select name="" v-model="package.category_id"  placeholder="select Category">

                                              <option value="2">Jobs</option>
                            

                       </select>
                      
                        <span class="help-block">
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
                    <button class="btn btn-primary" :disabled="package.busy" type="button" @click="postdata" >{{(isUpdate?"Update":"Create")}}</button>
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

 import editButton from './includes/edit';
 import deleteButton  from './includes/delete';
 import errorPage  from './includes/errors';


export default {
  data() {
    return {
      bars:"bars",
      error:null,
      url:process.env.MIX_APP_URL+'/dashboard/package/',
                      isUpdate:false,
                      package_id:"",
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
                    label: 'Category',
                    name: 'type',
                },
                 {
                    label: 'Time',
                    name: 'days',
                },
                   {
                    label: 'Price',
                    name: 'price',
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
      package: new Form({
        name: "",

        description: "",
        category_id: "",
        days:"",
        price:"",
      }),
    };
  },
  created() {
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
this.package.fill(data);
this.package_id=data.id;
  },
  remove(data){
    

  },
 
  reloadTable() {
    // this.filters.reset();
        this.getdata();

                // this.$refs.reloadingTheTable.getData()
            },
     

      
    getdata() {
                       this.$refs.reloadingTheTable.getData()

    },
    openModal(){

         $("#addCategory").modal("show");
                  this.package.reset();

         this.isUpdate=false;

    },
    postdata() {
      this.$validator.validateAll().then((result) => {
        if (result) {
            var url = "";
      if (this.isUpdate) {
        url = this.package.put("/dashboard/package/" + this.package_id);
      } else {
        url =           this.package.post("/dashboard/package");
      }
           url .then((res) => {
              if (res.status == 200) {

                this.$toastr.success(res.data, "Success");
                this.getdata();
        this.$validator.reset();

                    this.package.reset();
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
