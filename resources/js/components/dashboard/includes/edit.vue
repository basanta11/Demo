<template>
    <button :class="classes"   @click="click(data)" title="Update">
  <span>
            <i class="fa fa-edit" aria-hidden="true"></i>
  </span>

    </button>
</template>
<script>
export default {
    props: {
        data: {},
        name: {},
        click: {
            type: Function,
            default: () => {}
        },
        classes: {
            type: Object,
            default: () => ({ 
                'btn': true,
                'btn-success': true,
                'btn-sm': true,
            }),
        },
    }
}
</script>