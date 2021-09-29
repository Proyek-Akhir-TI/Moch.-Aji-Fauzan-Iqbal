<template>
    <div :class="['card',this.theme]" v-if="show">
      <!-- <div class="card-header py-4">
        <div class="card-tools">
          <button type="button" class="btn btn-tool"  >
            <i v-on:click="minimize" :class="['fas', this.iconmin]"></i>
          </button>
          
          <button type="button" class="btn btn-tool" >
            <i v-on:click="remove" class="fas fa-times"></i>
          </button>

        </div>
      </div> -->
      <div :class="[ this.isOpen ? '':'d-none' ,'card-body']">
        <slot></slot>
      </div>
    </div>
</template>

<script>
export default {
  name: 'va-card',
  props:{
    theme : {
      type : String,
      default : 'card-danger'
    }
  },
  data(){
    return{
        isOpen: true,
        iconmin : 'fa-minus',
        show : true
    }
},
  methods :{
    minimize(){
      if(this.isOpen == true){
        this.isOpen = false
        this.iconmin = 'fa-plus'
      }else{
        this.iconmin = 'fa-minus'
        this.isOpen = true
      }

    },
    remove(){
      this.show = false
    }
  }
}
</script>