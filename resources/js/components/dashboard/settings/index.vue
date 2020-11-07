<template>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="nav-tabs-boxed">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a
                                    class="nav-link active"
                                    data-toggle="tab"
                                    href="#home"
                                    role="tab"
                                    aria-controls="home"
                                    >Home</a
                                >
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    data-toggle="tab"
                                    href="#profile"
                                    role="tab"
                                    aria-controls="profile"
                                    >Socail</a
                                >
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    data-toggle="tab"
                                    href="#messages"
                                    role="tab"
                                    aria-controls="messages"
                                    >Seo</a
                                >
                            </li>
                        </ul>
                        <form
                            @submit.prevent="onSubmitClick"
                            @keydown="settings.errors.clear($event.target.name)"
                        >
                            <div class="tab-content">
                                <div
                                    class="tab-pane active"
                                    id="home"
                                    role="tabpanel"
                                >
                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="name"
                                        >
                                            Site Name</label
                                        >
                                        <div class="col-md-9">
                                            <input
                                                class="form-control"
                                                id="name"
                                                v-validate="'required'"
                                                type="text"
                                                name="name"
                                                v-model="settings.name"
                                                placeholder="Name"
                                            />
                                            <span class="help-block"></span>
                                            <span
                                                v-show="errors.has('name')"
                                                class="invalid"
                                                >{{
                                                    errors.first("name")
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="site_description"
                                            >Site Description</label
                                        >
                                        <div class="col-md-9">    
                                            <input
                                                class="form-control"
                                                v-validate="'required|'"
                                                id="site_description"
                                                type="text"
                                                name="site_description"
                                                placeholder="Enter Site Description"
                                                v-model="
                                                    settings.site_description
                                                "
                                                autocomplete="site_description"
                                            />
                                            <span class="help-block"></span>
                                            <span
                                                v-show="
                                                    errors.has(
                                                        'site_description'
                                                    )
                                                "
                                                class="invalid"
                                                >{{
                                                    errors.first(
                                                        "site_description"
                                                    )
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="email"
                                            >Primary Email</label
                                        >
                                        <div class="col-md-9">
                                            <input
                                                class="form-control"
                                                v-validate="'required|email'"
                                                id="email"
                                                type="email"
                                                name="email"
                                                placeholder="Enter Email"
                                                v-model="settings.email"
                                                autocomplete="email"
                                            />
                                            <span class="help-block"></span>
                                            <span
                                                v-show="errors.has('email')"
                                                class="invalid"
                                                >{{
                                                    errors.first("email")
                                                }}</span
                                            >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="email"
                                            >Secomdary Email</label
                                        >
                                        <div class="col-md-9">
                                            <input
                                                class="form-control"
                                                v-validate="'required|email'"
                                                id="email2"
                                                type="email"
                                                name="email2"
                                                placeholder="Enter Email"
                                                v-model="settings.email2"
                                                autocomplete="email2"
                                            />
                                            <span class="help-block"></span>
                                            <span
                                                v-show="errors.has('email2')"
                                                class="invalid"
                                                >{{
                                                    errors.first("email2")
                                                }}</span
                                            >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="email"
                                            >Mailing Address</label
                                        >
                                        <div class="col-md-9">
                                            <input
                                                class="form-control"
                                                v-validate="'required|email'"
                                                id="mail"
                                                type="email"
                                                name="mail"
                                                placeholder="Enter Mailing Address"
                                                v-model="settings.mail"
                                                autocomplete="mail"
                                            />
                                            <span class="help-block"></span>
                                            <span
                                                v-show="errors.has('mail')"
                                                class="invalid"
                                                >{{
                                                    errors.first("mail")
                                                }}</span
                                            >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="email"
                                            >Primary Phone</label
                                        >
                                        <div class="col-md-9">
                                            <input
                                                class="form-control"
                                                v-validate="'required'"
                                                id="phone"
                                                type="text"
                                                name="phone"
                                                placeholder="Enter Phone Number"
                                                v-model="settings.phone"
                                            />
                                            <span class="help-block"></span>
                                            <span
                                                v-show="errors.has('phone')"
                                                class="invalid"
                                                >{{
                                                    errors.first("phone")
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="email"
                                            >Secondary Phone</label
                                        >
                                        <div class="col-md-9">
                                            <input
                                                class="form-control"
                                                v-validate="'required|'"
                                                id="phone2"
                                                type="text"
                                                name="phone2"
                                                placeholder="Enter Secondary Phone"
                                                v-model="settings.phone2"
                                                autocomplete="phone2"
                                            />
                                            <span class="help-block"></span>
                                            <span
                                                v-show="errors.has('phone2')"
                                                class="invalid"
                                                >{{
                                                    errors.first("phone2")
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="email"
                                            >Logo</label
                                        >
                                        <div class="col-md-9">
                                            <input
                                                ref="fileInput"
                                                type="file"
                                                @input="
                                                    pickFile($event, 'logo')
                                                "
                                            />
                                            <div
                                                class="image-preview"
                                                v-if="
                                                    previewImage_logo.length > 0
                                                "
                                            >
                                                <img
                                                    class="preview"
                                                    width="150"
                                                    :src="previewImage_logo"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="fav_icon"
                                            >Fav Icon</label
                                        >
                                        <div class="col-md-9">
                                            <input
                                                ref="fileInput"
                                                type="file"
                                                @input="
                                                    pickFile($event, 'fav_icon')
                                                "
                                            />
                                            <div
                                                class="image-preview"
                                                v-if="
                                                    previewImage_fav_icon.length >
                                                        0
                                                "
                                            >
                                                <img
                                                    class="preview"
                                                    width="150"
                                                    :src="previewImage_fav_icon"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="tab-pane"
                                    id="profile"
                                    role="tabpanel"
                                >
                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="facebook"
                                            >Facebook</label
                                        >
                                        <div class="col-md-9">
                                            <input
                                                class="form-control"
                                                v-validate="''"
                                                id="facebook"
                                                type="text"
                                                name="facebook"
                                                placeholder="Enter Facebook Link"
                                                v-model="settings.facebook"
                                            />
                                            <span class="help-block"></span>
                                            <span
                                                v-show="errors.has('facebook')"
                                                class="invalid"
                                                >{{
                                                    errors.first("facebook")
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="instagram"
                                            >Instagram</label
                                        >
                                        <div class="col-md-9">
                                            <input
                                                class="form-control"
                                                v-validate="''"
                                                id="instagram"
                                                type="text"
                                                name="instagram"
                                                placeholder="Enter Instagram Link"
                                                v-model="settings.instagram"
                                            />
                                            <span class="help-block"></span>
                                            <span
                                                v-show="errors.has('instagram')"
                                                class="invalid"
                                                >{{
                                                    errors.first("instagram")
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="email"
                                            >Twitter</label
                                        >
                                        <div class="col-md-9">
                                            <input
                                                class="form-control"
                                                v-validate="''"
                                                id="twitter"
                                                type="text"
                                                name="twitter"
                                                placeholder="Enter Twitter Link"
                                                v-model="settings.twitter"
                                            />
                                            <span class="help-block"></span>
                                            <span
                                                v-show="errors.has('twitter')"
                                                class="invalid"
                                                >{{
                                                    errors.first("twitter")
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="tab-pane"
                                    id="messages"
                                    role="tabpanel"
                                >
                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="meta_title"
                                            >Meta title</label
                                        >
                                        <div class="col-md-9">
                                            <input
                                                class="form-control"
                                                v-validate="''"
                                                id="meta_title"
                                                type="text"
                                                name="meta_title"
                                                placeholder="Enter Secondary Phone"
                                                v-model="settings.meta_title"
                                            />
                                            <span class="help-block"></span>
                                            <span
                                                v-show="
                                                    errors.has('meta_title')
                                                "
                                                class="invalid"
                                                >{{
                                                    errors.first("meta_title")
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="meta_description"
                                            >Meta Description</label
                                        >
                                        <div class="col-md-9">
                                            <textarea
                                                type="text"
                                                class="form-control"
                                                placeholder="Description"
                                                rows="5"
                                                name="meta_description"
                                                v-model="
                                                    settings.meta_description
                                                "
                                            ></textarea>
                                            <span class="help-block"></span>
                                            <span
                                                v-show="
                                                    errors.has(
                                                        'meta_description'
                                                    )
                                                "
                                                class="invalid"
                                                >{{
                                                    errors.first(
                                                        "meta_description"
                                                    )
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="keywords"
                                            >Key Words</label
                                        >
                                        <div class="col-md-9">
                                            <textarea
                                                type="text"
                                                class="form-control"
                                                rows="5"
                                                name="keywords"
                                                v-model="settings.keywords"
                                            ></textarea>
                                            <span class="help-block"></span>
                                            <span
                                                v-show="errors.has('keywords')"
                                                class="invalid"
                                                >{{
                                                    errors.first("keywords")
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">
                            <button
                                class="btn  btn-primary"
                                @click="onSubmitClick"
                                type="submit"
                            >
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.col-->

            <!-- /.col-->
        </div>

        <!-- /.row-->
    </div>
</template>

<script>
export default {
    data() {
        return {
            previewImage_logo: "",
            previewImage_fav_icon: "",

            settings: new Form({
                name: "",
                email: "",
                email2: "",
                mail: "",
                phone: "",
                phone2: "",
                facebook: "",
                instagram: "",
                twitter: "",
                meta_title: "",
                meta_description: "",
                keywords: "",
                site_description: "",
                logo: "",
                fav_icon: ""
            })
        };
    },
    created() {
        this.getdata();
    },
    mounted() {},
    methods: {
        getdata() {
            axios.get("/dashboard/settings").then(res => {
                this.settings.fill(res.data);
                if (this.settings.logo) {
                    this.previewImage_logo =
                        process.env.MIX_APP_URL + "/" + this.settings.logo;
                }
                if (this.settings.fav_icon) {
                    this.previewImage_fav_icon =
                        process.env.MIX_APP_URL + "/" + this.settings.fav_icon;
                }
            });
        },

        pickFile: function(event, name) {
            var input = event.target;
            if (name == "logo") {
                this.settings.logo = event.target.files[0];
            }
            if (name == "fav_icon") {
                this.settings.fav_icon = event.target.files[0];
            }
            // Ensure that you have a file before attempting to read it
            if (input.files && input.files[0]) {
                // create a new FileReader to read this image and convert to base64 format
                var reader = new FileReader();
                // Define a callback function to run, when FileReader finishes its job
                reader.onload = e => {
                    // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                    // Read image as base64 and set to imageData
                    if (name == "logo") {
                        this.previewImage_logo = e.target.result;
                    }
                    if (name == "fav_icon") {
                        this.previewImage_fav_icon = e.target.result;
                    }
                    // Start the reader job - read file as a data url (base64 format)
                };
                reader.readAsDataURL(input.files[0]);
            }
        },
        onSubmitClick() {
            this.$validator.validateAll().then(result => {
                if (result) {
                    this.settings
                        .submit("post", "/dashboard/settings", {
                            // Transform form data to FormData
                            transformRequest: [
                                function(data, headers) {
                                    return objectToFormData(data);
                                }
                            ]
                        })
                        .then(res => {
                            if (res.status == 200) {
                                this.$toastr.success(
                                    res.data.success,
                                    "Success"
                                );
                                this.getdata();
                            }
                        })
                        .catch(e => {
                            this.$toastr.error("Something went wrong", "Error");
                        });
                }
            });
        }
    }
};
</script>
