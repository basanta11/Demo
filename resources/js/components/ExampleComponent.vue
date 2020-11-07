<template>
       
<div>
    <div class="card">
                    <div class="card-body">

                      
                                <div class="col-sm-4 col-sm-offset-1">
                                    <div class="picture-container">
                                        <div class="picture">
                                          
                                            <input 
                                           @input="pickFile($event)"
 
                                                type="file"
                                               webkitdirectory directory multiple>
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
  
</template>

<script>

export default {
    data() {
        return {
       files:[],
        };
    },
    created() {
    },

  
    methods: {
     pickFile: function(event) {
       let files=event.target.files;
                for (let newFile of files) {
                    try {
                        let reader = new FileReader();
                        reader.readAsDataURL(newFile); // Not sure if this will work in this context.
                        this.files.push(newFile);
                    } catch {
                      alert('something went wrong');
                    }
                }
            },
       
     
        postData() {
          console.log('click');
           let formData = new FormData();
      
        for( var i = 0; i < this.files.length; i++ ){
          let file = this.files[i];
          formData.append('files[' + i + ']', file);
        }
  axios.post( '/upload-files',
          formData,
          {
            headers: {
                'Content-Type': 'multipart/form-data',
                         'X-CSRF-Token': document.head.querySelector('meta[name="csrf-token"]').content,

            }
          }
        ).then(function(){
          console.log('SUCCESS!!');
        })
        .catch(function(){
          console.log('FAILURE!!');
        });

          
        }
    }
};
</script>
