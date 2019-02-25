<script>
export default {
  el: '#app',
  name: 'App',
  data () {
    return {
      widthSize: 100,
      drawer: null,
      drawerRight: false,
      items: [
        { icon: 'home', text: 'Home', url: '/' },
        { icon: 'content_copy', text: 'Tasks', url: '/tasks' },
        { icon: 'history', text: 'Tasks Vue', url: '/tasks_vue' },
        { icon: 'history', text: 'Tasks Tailwind', url: '/tasks_tailwind' },
        { icon: 'build', text: 'Tasques', url: '/tasques' },
        { icon: 'donut_large', text: 'Tags', url: '/tags' },
        { icon: 'donut_large', text: 'Perfil', url: '/profile' },
        { icon: 'account_circle', text: 'Contact', url: '/contact' },
        { icon: 'donut_large', text: 'About', url: '/about' },
        { icon: 'assessment', text: 'Changelog', url: '/changelog' },
        { icon: 'notifications', text: 'Notifications', url: '/notifications' }
        // { icon: 'chat_bubble', text: 'Send feedback' },
        // { icon: 'help', text: 'Help' }
        // { icon: 'phonelink', text: 'App downloads' },
        // { icon: 'keyboard', text: 'Go to the old version' }
      ]
    }
  },
  methods: {
    impersonate (user) {
      console.log('IMPERSONATE')
      console.log('user:')
      console.log(user)
      if (user) {
        window.location.href = '/impersonate/take/' + user
      } else {
        console.log('CACA')
      }
    }
  }
}
</script>
