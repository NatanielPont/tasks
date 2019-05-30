import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import './bootstrap'
import AppComponent from './components/App.vue'
import ExampleComponent from './components/ExampleComponent.vue'
import Tasks from './components/tasques/vue/Tasks.vue'
import Tags from './components/tags/Tags.vue'
import TasksTailwind from './components/tasques/tailwind/TasksTailwind.vue'
import Tasques from './components/tasques/Tasques.vue'
import LoginForm from './components/LoginForm.vue'
import Chat from './components/chat/Chat'
import Newsletter from './components/newsletters/Newsletters'
import NewsletterSubscriptionCard from './components/newsletters/NewslettersSubscriptionCard'
import ShareTask from './components/tasques/ui/ShareTask'
import ShowTask from './components/tasques/ui/ShowTask'
import ProfileDrawer from './components/chat/ProfileDrawer'
import ToolbarCanals from './components/chat/ToolbarCanals'
import MenuCanals from './components/chat/MenuCanals'
import NewChatDrawer from './components/chat/NewChatDrawer'
import Users from './components/users/Users'
import UsersOnlineWidget from './components/users/UsersOnlineWidget'
import Game from './components/game/Game'
import Multimedia from './components/multimedia/Multimedia'
// import PushNotificationButton from './components/push_subscription/PushNotificationButton'

// import ResetPasswordForm from './components/ResetPasswordForm'
// import EditableForm from './components/EditableForm'
import RegisterForm from './components/RegisterForm.vue'
import UserList from './components/UserList'
import UserSelect from './components/UserSelect'
// import Snackbar from './components/ui/SnackBar'
import snackbar from './plugins/snackbar'
import confirm from './plugins/confirm'

import permissions from './plugins/permissions'
import Impersonate from './components/Impersonate'
import GitInfo from './components/git/GitInfoComponent'
import Tema from './components/Tema.vue'
import Profile from './components/Profile'
import ServiceWorker from './components/ServiceWorker'
import Changelog from './components/changelog/ChangelogComponent.vue'
import Notifications from './components/notifications/Notifications'
import NotificationsWidget from './components/notifications/NotificationsWidget'
import UserSelectComponent from './components/users/UsersSelectComponent'
import Navigation from './components/Navigation'
import NavigationRight from './components/NavigationRigt'

import DataIteratorTasks from './components/tasques/DataIteratorTasks'
import SwipeComponent from './components/tasques/SwipeComponent'
import NoDataComponent from './components/tasques/NoDataComponent'
import DataTableTasks from './components/tasques/DataTableTasks'
import DataIteratorTags from './components/tags/DataIteratorTags'
import DataIteratorChangelog from './components/changelog/DataIteratorChangelogMobile'
import DataTableTags from './components/tags/DataTableTags'
import TreeView from 'vue-json-tree-view'
import VueTimeago from 'vue-timeago'
import '../../node_modules/timeline-vuejs/dist/timeline-vuejs.css'
import MainToolbar from './components/MainToolbar'
import Clock from './components/clock/Clock'
import Mobile from './components/mobile/Mobile'
import Memory from './components/mobile/Memory'
import Battery from './components/mobile/Battery'
import NetworkAndSpeed from './components/mobile/NetworkAndSpeed'
import OnlineState from './components/mobile/OnlineState'
import Geolocation from './components/mobile/Geolocation'
import DevicePosition from './components/mobile/DevicePosition'
import ShareFab from './components/ui/ShareFab'
import PushNotificationButton from './components/push_subscription/PushNotificationButton'

// import Vue2TouchEvents from 'vue2-touch-events'

// import Timeline from 'timeline-vuejs'

// import VueTimeago from 'vue-timeago'

window.Vue = Vue
window.Vuetify = Vuetify
const PRIMARY_COLOR_KEY = 'primary_color_key'
const GREY_COLOR_KEY = 'grey_color_key'
const ACCENT_COLOR_KEY = 'accent_color_key'
const primaryColor = window.localStorage.getItem(PRIMARY_COLOR_KEY) || '#2BB0ED' // '#2680C2'
// const FinalprimaryColor = window.localStorage.getItem(FINAL_PRIMARY_COLOR_KEY) || '#2BB0ED' // '#2680C2'
const greyColor = window.localStorage.getItem(GREY_COLOR_KEY) || '#627D98' // '#2680C2'
const accentColor = window.localStorage.getItem(ACCENT_COLOR_KEY) || '#DA127D' // '#2680C2'
// const FinalgreyColor = window.localStorage.getItem(FINAL_GREY_COLOR_KEY) || '#334E68' // '#2680C2'
// window.Vue.use(VueTimeago, {
//   locale: 'ca', // Default locale
//   locales: {
//     'ca': require('date-fns/locale/ca')
//   }
// })
window.Vue.use(VueTimeago, {
  locale: 'ca', // Default locale
  locales: {
    'ca': require('date-fns/locale/ca')
  }
})
window.Vue.use(TreeView)
// window.Vue.use(Timeline)

window.Vue.use(window.Vuetify, {
  theme: {
    primary: {
      base: primaryColor,
      lighten1: '#40C3F7',
      lighten2: '#5ED0FA',
      lighten3: '#81DEFD',
      lighten4: '#B3ECFF',
      lighten5: '#E3F8FF',
      darken1: '#1992D4',
      darken2: '#127FBF',
      darken3: '#0B69A3',
      darken4: '#035388'
    },
    secondary: {
      base: '#616E7C',
      lighten1: '#7B8794',
      lighten2: '#9AA5B1',
      lighten3: '#CBD2D9',
      lighten4: '#E4E7EB',
      lighten5: '#F5F7FA',
      darken1: '#52606D',
      darken2: '#3E4C59',
      darken3: '#323F4B',
      darken4: '#1F2933'
    },
    accent: {
      base: accentColor,
      lighten1: '#E8368F',
      lighten2: '#F364A2',
      lighten3: '#FF8CBA',
      lighten4: '#FFB8D2',
      lighten5: '#FFE3EC',
      darken1: '#BC0A6F',
      darken2: '#A30664',
      darken3: '#870557',
      darken4: '#620042'

    },
    error: {
      base: '#E12D39',
      lighten1: '#EF4E4E',
      lighten2: '#F86A6A',
      lighten3: '#FF9B9B',
      lighten4: '#FFBDBD',
      lighten5: '#FFE3E3',
      darken1: '#CF1124',
      darken2: '#AB091E',
      darken3: '#8A041A',
      darken4: '#610316'
    },
    success: {
      base: '#27AB83',
      lighten1: '#3EBD93',
      lighten2: '#65D6AD',
      lighten3: '#8EEDC7',
      lighten4: '#C6F7E2',
      lighten5: '#EFFCF6',
      darken1: '#199473',
      darken2: '#147D64',
      darken3: '#0C6B58',
      darken4: '#014D40'
    },
    grey: {
      base: greyColor,
      lighten1: '#829AB1',
      lighten2: '#9FB3C8',
      lighten3: '#BCCCDC',
      lighten4: '#D9E2EC',
      lighten5: '#F0F4F8',
      darken1: '#486581',
      darken2: '#334E68',
      darken3: '#243B53',
      darken4: '#102A43'
    }
  }
})

// window.Vue = Vue
window.Vue.use(Vuetify)
window.Vue.use(permissions)
window.Vue.use(snackbar)
window.Vue.use(confirm)

window.Vue.component('example-component', ExampleComponent)
window.Vue.component('tasks', Tasks)
window.Vue.component('tags', Tags)
window.Vue.component('taskstailwind', TasksTailwind)
window.Vue.component('tasques', Tasques)
window.Vue.component('login-form', LoginForm)
window.Vue.component('register-form', RegisterForm)
// window.Vue.component('editable-form', EditableForm)
window.Vue.component('user-list', UserList)
window.Vue.component('user-select', UserSelect)
window.Vue.component('impersonate', Impersonate)
window.Vue.component('git-info', GitInfo)
window.Vue.component('tema', Tema)
window.Vue.component('profile', Profile)
window.Vue.component('changelog', Changelog)
window.Vue.component('navigation', Navigation)
window.Vue.component('navigation-right', NavigationRight)
window.Vue.component('service-worker', ServiceWorker)
// window.Vue.component('service-worker', ServiceWorker)
// Notifications
window.Vue.component('notifications', Notifications)
window.Vue.component('notifications-widget', NotificationsWidget)
window.Vue.component('user-select-component', UserSelectComponent)
window.Vue.component('data-iterator-tasks', DataIteratorTasks)
window.Vue.component('data-table-tasks', DataTableTasks)
window.Vue.component('data-iterator-tags', DataIteratorTags)
window.Vue.component('data-iterator-changelog', DataIteratorChangelog)
window.Vue.component('data-table-tags', DataTableTags)
window.Vue.component('main-toolbar', MainToolbar)
window.Vue.component('clock', Clock)
window.Vue.component('swipe-component', SwipeComponent)
window.Vue.component('no-data-component', NoDataComponent)
window.Vue.component('mobile', Mobile)
window.Vue.component('memory', Memory)
window.Vue.component('battery', Battery)
window.Vue.component('network-speed', NetworkAndSpeed)
window.Vue.component('online-state', OnlineState)
window.Vue.component('geolocation', Geolocation)
window.Vue.component('device-position', DevicePosition)
window.Vue.component('share-fab', ShareFab)
window.Vue.component('chat', Chat)
window.Vue.component('newsletters', Newsletter)
window.Vue.component('newsletters-subscription-card', NewsletterSubscriptionCard)
window.Vue.component('share-task', ShareTask)
window.Vue.component('show-task', ShowTask)
window.Vue.component('profile-drawer', ProfileDrawer)
window.Vue.component('toolbar-canals', ToolbarCanals)
window.Vue.component('menu-canals', MenuCanals)
window.Vue.component('new-chat-drawer', NewChatDrawer)
window.Vue.component('users-list', Users)
window.Vue.component('users-online-widget', UsersOnlineWidget)
window.Vue.component('game', Game)
window.Vue.component('multimedia', Multimedia)
window.Vue.component('push-notification-button', PushNotificationButton)
window.eventBus = new Vue()

// Vue.use(Vue2TouchEvents)

// Changelog
// window.Vue.component('reset-password-form', ResetPasswordForm)

// window.Vue.component('snackbar', Snackbar)

// eslint-disable-next-line no-unused-vars
const app = new window.Vue(AppComponent)
