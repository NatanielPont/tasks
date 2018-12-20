<template>
    <span>
        <span v-if="!editing" @dblclick="editing=true">
            {{ currentText }}
        </span>
        <span v-if="editing" @keyup.esc="resetName"
              @keyup.enter="edit" >
            <input type="text" v-model="currentText">
            <v-btn id="buttonEdit" @click="edit" small><v-icon color="orange">edit</v-icon></v-btn>
    <span align="right">

    </span>
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
