<template>
<div>
  <div v-if="error" class="alert alert-danger" role="alert">
  
    Whoops! Something didn't work. 
            <ul>
              <div v-for="(v, k) in error" :key="k">
                <li>{{ v[0] }}</li>
              </div>
            </ul>
</div>
</div>
</template>
<script>
 export default {
   props: {
   error: null
 },
  data() {
    return {
   props: {
   }
    }
  },
 }
 </script>