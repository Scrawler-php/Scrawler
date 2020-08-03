<template>
  <div>
    <h1>Hello {{name}}</h1>
  </div>
</template>


<script lang="ts">
import Vue from 'vue'
import { Component} from 'vue-property-decorator'

@Component
export default class App extends Vue {
    name:any

}

</script>



<style lang="css">

</style>