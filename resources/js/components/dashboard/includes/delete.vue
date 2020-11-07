<template>
    <button :class="classes" @click="click(data)"  title="Delete">
         <span>
            <i class="fa fa-trash" aria-hidden="true"></i>
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
                'btn-danger': true,
                'btn-sm': true,
            }),
        },
    }
}
</script>
