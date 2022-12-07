<template>
  <button :type="type" class="btn btn-warning fw-bold">
    <slot></slot>
  </button>
</template>

<script>
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      type: {
        type: String,
        default: 'submit',
      },
    }
  })
</script>
