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
              user
              <button
                class="btn float-right btn-primary mb-1"
                type="button"
            @click="openModal"
              >Add user</button>
            </h2>
          </div>

          <div class="card-body">
            <div
              class="modal fade"
              id="addUser"
              tabindex="-1"
              role="dialog"
              aria-labelledby="myModalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Add user</h4>
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
                          v-model="user.name"
                        />
                        <span class="help-block"></span>
                        <span
                          v-show=" errors.has('name') "
                          class="invalid"
                        >{{ errors.first('name') }}</span>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="email">Email</label>
                      <div class="col-md-9">
                        <input
                          class="form-control"
                          v-validate="'required|email'"
                          id="icon"
                          type="text"
                          name="email"
                          placeholder="Enter email "
                          v-model="user.email"
                        />
                        <span class="help-block">
                         
                        </span>
                        <span
                          v-show=" errors.has('email') "
                          class="invalid"
                        >{{ errors.first('email') }}</span>
                      </div>
                    </div>
                     <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="phone">phone</label>
                      <div class="col-md-9">
                        <input
                          class="form-control"
                          v-validate="'required'"
                          id="icon"
                          type="text"
                          name="phone"
                          placeholder="Enter phone Number"
                          v-model="user.phone"
                          autocomplete="phone"
                        />
                        <span class="help-block">
                         
                        </span>
                        <span
                          v-show=" errors.has('phone') "
                          class="invalid"
                        >{{ errors.first('phone') }}</span>
                      </div>
                    </div>
                     <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="password">password</label>
                      <div class="col-md-9">
                        <input
                          class="form-control"
                          v-validate="{ required: this.isUpdate==false }"
                          id="icon"
                          type="password"
                          name="password"
                          placeholder="Enter password "
                          v-model="user.password"
                        />
                        <span class="help-block">
                         
                        </span>
                        <span
                          v-show=" errors.has('password') "
                          class="invalid"
                        >{{ errors.first('password') }}</span>
                      </div>
                    </div>
                     <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="password_confirmation">Re Type Password</label>
                      <div class="col-md-9">
                        <input
                          class="form-control"
                          v-validate="{ required: this.isUpdate==false }"
                          id="icon"
                          type="password"
                          name="password_confirmation"
                          placeholder="Enter password_confirmation Number"
                          v-model="user.password_confirmation"
                        />
                        <span class="help-block">
                         
                        </span>
                        <span
                          v-show=" errors.has('password_confirmation') "
                          class="invalid"
                        >{{ errors.first('password_confirmation') }}</span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="parent_id">Select Role</label>
                      <div class="col-md-9">
                         <model-select :options="options"
                                v-model="user.role"
                                placeholder="select item">
         </model-select>
                      
                        <span class="help-block">
                        Leave Blank For Normal User
                        </span>
                        <span
                          v-show=" errors.has('role') "
                          class="invalid"
                        >{{ errors.first('role') }}</span>
                      </div>
                    </div>
                   
                  <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="active">Status</label>
                      <div class="col-md-9">
                <select class="form-control" name="active " id="active" v-model="user.is_active">
                  <option value="1">Active</option>
                  <option value="0">Block</option>
                </select>
             <span class="help-block">
                         Selectr In Actve To Block user
                        </span>
                        <span
                          v-show=" errors.has('is_active') "
                          class="invalid"
                        >{{ errors.first('is_active') }}</span>
              </div>
                  </div>

                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" :disabled="user.busy" type="button" @click="postdata" >{{(isUpdate?"Update":"Create")}}</button>
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
                                placeholder="select user">
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
      url:process.env.MIX_APP_URL+'/dashboard/user/',
                      isUpdate:false,
                      user_id:"",
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
                    label: 'Phone',
                    name: 'phone',
                    orderable: false,
                },
                  {
                    label: 'Role',
                    name: 'r_name',
                    orderable: false,
                },
                 {
                    label: 'Status',
                    name: 'active',
                    orderable: true,
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
      user: new Form({
        name: "",
        email: "",
        phone:"",
        password:"",
        password_confirmation:"",
        role:"",
        is_active:""
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
             $("#addUser").modal("show");
                     this.$validator.reset();

this.isUpdate=true;
this.user.fill(data);
this.user_id=data.id;
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
           axios.get("/dashboard/user/getRoles").then((res) => {
       this.options=res.data;
      });

      },
    getdata() {
                       this.$refs.reloadingTheTable.getData()

    },
    openModal(){

         $("#addUser").modal("show");
         this.user.reset();
         this.isUpdate=false;

    },
    postdata() {
      this.$validator.validateAll().then((result) => {
        if (result) {
            var url = "";
      if (this.isUpdate) {
        url = this.user.put("/dashboard/user/" + this.user_id);
      } else {
        url =           this.user.post("/dashboard/user");
      }
           url .then((res) => {
              if (res.status == 200) {

                this.$toastr.success(res.data, "Success");
                this.getdata();
                     this.getoptions();
        this.$validator.reset();

                    this.user.reset();
   $("#addUser").modal("hide");
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
