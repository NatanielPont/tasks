<template>
    <span>
        <span v-if="!editing" @dblclick="editing=true" >
            {{ currentText }}
            <svg @click="editing=true" class=" fill-current text-red ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" height="15"><path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/></svg> <!-- Edit -->

        </span>
        <span v-if="editing" @keyup.esc="resetName"
              @keyup.enter="edit" >
            <input type="text" v-model="currentText" class="text-center">
           <div class="pepe">
             <svg @click="edit"  class=" fill-current text-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" height="15">
                 <path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/>
             </svg><svg @click="editing=false" class=" fill-current text-red" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" height="15">
                 <path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/>
             </svg>
           </div>

            <!--<v-btn id="buttonEdit" @click="edit" small><v-icon color="orange">edit</v-icon></v-btn>-->

            <!--// SINTAX SUGAR-->
            <!--<input type="text" :value="currentText" @input="currentText= $event.target.value">-->
        </span>
    </span>
</template>

<script>
export default {
  name: 'EditableText',
  data () {
    return {
      editing: false,
      currentText: this.text,
      taskName: this.text
    }
  },
  props: {
    'text': {
      type: String,
      required: true
    }
  },
  watch: {
    text (newText) {
      this.currentText = this.text
    }
  },
  // props: ['text'],
  methods: {
    resetName () {
      this.editing = false
      this.currentText = this.taskName
    },
    edit () {
      if ((this.currentText.length) >= 25) {
        this.currentText = this.currentText.substring(0, 25)
      }
      if ((this.currentText.length) === 0) {
        this.currentText = this.taskName
      }
      // console.log('hola')

      this.editing = false
      // INFORMAR AL PARE
      this.$emit('edited', this.currentText)
    }
  },
  created () {
    // console.log('Component EditableText ha estat creat');
  }
}
</script>

<style>
    .pepe {
        text-decoration: none;
    }
</style>
