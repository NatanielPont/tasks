<script>
export default {
  el: '#app',
  name: 'App',
  data () {
    return {
      drawer: null,
      items: [
        { icon: 'home', text: 'Home', url: '/' },
        { icon: 'content_copy', text: 'Tasks', url: '/tasks' },
        { icon: 'account_circle', text: 'Contact', url: '/contact' },
        { icon: 'donut_large', text: 'About', url: '/about' },
        { icon: 'history', text: 'Tasks Vue', url: '/tasks_vue' },
        // {
        //   icon: 'keyboard_arrow_up',
        //   'icon-alt': 'keyboard_arrow_down',
        //   text: 'Labels',
        //   model: true,
        //   children: [
        //     { icon: 'add', text: 'Create label' }
        //   ]
        // },
        // {
        //   icon: 'keyboard_arrow_up',
        //   'icon-alt': 'keyboard_arrow_down',
        //   text: 'More',
        //   model: false,
        //   children: [
        //     { text: 'Import' },
        //     { text: 'Export' },
        //     { text: 'Print' },
        //     { text: 'Undo changes' },
        //     { text: 'Other contacts' }
        //   ]
        // },
        { icon: 'settings', text: 'Settings' },
        { icon: 'chat_bubble', text: 'Send feedback' },
        { icon: 'help', text: 'Help' },
        { icon: 'phonelink', text: 'App downloads' },
        { icon: 'keyboard', text: 'Go to the old version' }
      ]
    }
  }
}
</script>
