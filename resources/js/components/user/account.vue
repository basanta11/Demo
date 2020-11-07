<template>
    <div class="dashboard-content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-primary">
                    <div class="card-header">
                        <div id="titlebar" style="margin:0">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Account</h2>
                                    <!-- Breadcrumbs -->
                                    <nav id="breadcrumbs">
                                        <ul>
                                            <li>
                                                <a href="#">Home</a>
                                            </li>
                                            <li>
                                                <a href="#">Dashboard</a>
                                            </li>
                                            <li>Account</li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <error-Page :error="error"></error-Page>

                        <div class="tab-content">
                            <div class="row wizard-card">
                                <div class="col-sm-4 col-sm-offset-1">
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img
                                                :src="previewImage"
                                                class="picture-src"
                                                id="wizardPicturePreview"
                                                title=""
                                            />
                                            <input
                                                type="file"
                                                @input="pickFile($event, 'pp')"
                                                id="wizard-picture"
                                            />
                                        </div>
                                        <h6>Choose Picture</h6>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>
                                            Name
                                            <small>(required)</small></label
                                        >
                                        <input
                                            name="name"
                                            v-model="user.name"
                                            v-validate="'required'"
                                            type="text"
                                            class="form-control"
                                            placeholder="Andrew..."
                                        />
                                        <span
                                            v-show="errors.has('name')"
                                            class="invalid"
                                            >{{ errors.first("name") }}</span
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label
                                            >Email
                                            <small>(required)</small></label
                                        >
                                        <input
                                            class="form-control"
                                            v-validate="'required|email'"
                                            type="text"
                                            name="email"
                                            placeholder="Enter email "
                                            v-model="user.email"
                                        />
                                        <span
                                            v-show="errors.has('email')"
                                            class="invalid"
                                            >{{ errors.first("email") }}</span
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label
                                            >Phone
                                            <small>(required)</small></label
                                        >
                                        <input
                                            class="form-control"
                                            v-validate="'required'"
                                            type="text"
                                            name="phone"
                                            placeholder="Enter phone Number"
                                            v-model="user.phone"
                                            autocomplete="phone"
                                        />
                                        <span
                                            v-show="errors.has('phone')"
                                            class="invalid"
                                            >{{ errors.first("phone") }}</span
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label
                                            >Password
                                            <small
                                                >Leave Empty If You Dont want to
                                                Change Your Password</small
                                            ></label
                                        >
                                        <input
                                            class="form-control"
                                            type="password"
                                            name="password"
                                            placeholder="Enter password "
                                            v-model="user.password"
                                        />
                                        <span
                                            v-show="errors.has('password')"
                                            class="invalid"
                                            >{{
                                                errors.first("password")
                                            }}</span
                                        >
                                    </div>
                                    <div class="form-group">
                                        <label
                                            >PassWord Confirmation
                                            <small></small
                                        ></label>
                                        <input
                                            class="form-control"
                                            type="password"
                                            name="password_confirmation"
                                            placeholder="Enter password_confirmation Number"
                                            v-model="user.password_confirmation"
                                        />
                                        <span
                                            v-show="
                                                errors.has(
                                                    'password_confirmation'
                                                )
                                            "
                                            class="invalid"
                                            >{{
                                                errors.first(
                                                    "password_confirmation"
                                                )
                                            }}</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button
                            class="btn  btn-primary"
                            @click="postData"
                            type="submit"
                        >
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import errorPage from "../dashboard/includes/errors";

export default {
    data() {
        return {
            bars: "bars",
            error: null,
            user_id: "",
           previewImage:"",
            user: new Form({
                name: "",
                email: "",
                phone: "",
                password: "",
                password_confirmation: "",
                pp: ""
            })
        };
    },
    created() {
        this.getdata();
    },

    components: {
        "error-Page": errorPage
    },
    methods: {
        getdata() {
            axios.get("/user/getdata").then(res => {
                this.user.fill(res.data);
                this.user_id = res.data.id;
                this.previewImage=res.data.image;
            });
        },
        pickFile: function(event, name) {
                        var input = event.target;

            this.user[name] = input.files[0];
              if (input.files && input.files[0]) {
                // create a new FileReader to read this image and convert to base64 format
                var reader = new FileReader();
                // Define a callback function to run, when FileReader finishes its job
                reader.onload = e => {
                    // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                    // Read image as base64 and set to imageData
                        this.previewImage = e.target.result;
                  
                    // Start the reader job - read file as a data url (base64 format)
                };
                reader.readAsDataURL(input.files[0]);
            }
        },
        postData() {
            this.$validator.validateAll().then(result => {
                if (result) {
                    this.user
                        .submit(
                            "post",
                            "/dashboard/edit/user/" + this.user_id,

                            {



                                    transformRequest: [
                                                    function(data, headers) {
                                                        return objectToFormData(data);
                                                    }
                                                ]}
                        )
                        .then(res => {
                            if (res.status == 200) {
                                this.$toastr.success(res.data, "Success");
                                 this.getdata();
                            }
                        })
                        .catch(e => {
                            this.error = e.response.data.errors;
                            this.$toastr.error("Something went wrong", "Error");
                        });
                }
            });
        }
    }
};
</script>
