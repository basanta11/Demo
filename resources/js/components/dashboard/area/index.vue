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
              Areas
              <button
                class="btn float-right btn-primary mb-1"
                type="button"
            @click="openModal"
              >Add Area</button>
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
                    <h4 class="modal-title">Add Area</h4>
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
                          v-model="area.name"
                          autocomplete="name"
                        />
                        <span class="help-block"></span>
                        <span
                          v-show=" errors.has('name') "
                          class="invalid"
                        >{{ errors.first('name') }}</span>
                      </div>
                    </div>

                   
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" :disabled="area.busy" type="button" @click="postdata" >{{(isUpdate?"Update":"Create")}}</button>
                  </div>
                </div>
                <!-- /.modal-content-->
              </div>
              <!-- /.modal-dialog-->
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

 import editButton from '../includes/edit';
 import deleteButton  from '../includes/delete';
 import errorPage  from '../includes/errors';


export default {
  data() {
    return {
      bars:"bars",
      error:null,
      url:process.env.MIX_APP_URL+'/dashboard/area/',
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
      area: new Form({
        name: "",
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
             $("#addArea").modal("show");
this.isUpdate=true;
this.area.fill(data);
this.area_id=data.id;
  },
  remove(data){
    if(confirm('are you sure?'))
        axios.delete('/dashboard/area/'+data.id)
          .then(res => {
                              this.$toastr.success(res.data, "Success");

this.getdata();
        })
          .catch(error => {
              this.$toastr.error("Something went wrong", "Error");
        })

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

         $("#addArea").modal("show");
                  this.area.reset();

         this.isUpdate=false;

    },
    postdata() {
      this.$validator.validateAll().then((result) => {
        if (result) {
            var url = "";
      if (this.isUpdate) {
        url = this.area.put("/dashboard/area/" + this.area_id);
      } else {
        url =           this.area.post("/dashboard/area");
      }
           url .then((res) => {
              if (res.status == 200) {

                this.$toastr.success(res.data, "Success");
                this.getdata();

                    this.area.reset();
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
  },
   mounted(){

  }
 
 
}
</script>
