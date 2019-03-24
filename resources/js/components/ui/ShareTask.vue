<template>
    <v-btn
            v-if="show"
            color="accent"
            @click="share"
            dark
            icon
            flat
    >
        <v-icon>share</v-icon>
    </v-btn>
</template>

<script>
export default {
  name: 'ShareTask',
  data () {
    return {
      dataTitle: this.title,
      dataText: this.text,
      dataUrl: this.url
    }
  },
  props: {
    task: {
      type: Object,
      required: true
    }
  },
  computed: {
    show () {
      return ('share' in navigator)
    }
  },
  methods: {
    share () {
      navigator.share({
        title: 'Tasca ' + this.task.name,
        text: this.task.description,
        url: 'https://tasks.natanielpont.scool.cat/tasques'
      })
        .then(() => console.log('Successful share'))
        .catch(error => console.log('Error sharing:', error))
    }
  }
}
</script>
