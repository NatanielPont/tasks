<template>
    <v-container fluid grid-list-md>
        <v-timeline class="grey lighten-4" dense clipped>

            <v-data-iterator
                    :search="search"
                    :items="timeline"
                    :rows-per-page-items="rowsPerPageItems"
                    :pagination.sync="pagination"
                    no-results-text="No s'ha trobat cap registre coincident"
                    no-data-text="No hi han dades disponibles"
                    rows-per-page-text="Registres per pàgina"
                    row
                    wrap

            >
                <v-timeline-item
                        slot="item"
                        slot-scope="{ item: log}"
                        :key="log.id"
                        class="mb-3"
                        :color="log.color"
                        :icon="log.icon"
                        small
                >
                    <v-card>
                        <v-list dense>
                            <v-card-title class="subheading  primary">
                                <v-flex class="mb-3">

                                <template v-if="log.user_name">
                                    <user-avatar class="mr-3" :hash-id="log.user_hashid"
                                                 :alt="log.user_name"
                                    ></user-avatar>
                                    <span :title="log.user_email">{{log.user_name}}</span>
                                </template>
                                <template v-else>Cap usuari</template>
                                </v-flex>
                            </v-card-title>

                            <v-list-tile>
                                <v-flex>

                                <timeago v-if="realTime" :title="log.formatted_time" :datetime="typeof log.time === 'object' ? log.time.date : log.time" :auto-update="1" :converterOptions="{ includeSeconds: true }"></timeago>
                                <span :title="log.formatted_time" v-else>{{ log.human_time }}</span>
                                </v-flex>
                            </v-list-tile>
                            <v-list-tile>
                                <v-flex  v-html="log.text" ></v-flex>

                            </v-list-tile>
                            <v-list-tile>
                                <v-flex  >
                                <compare-values  name="Compara" title="Compara valor àntic i valor nou" :log="log"></compare-values>
                                </v-flex>
                            </v-list-tile>
                            <v-list-tile>
                                <v-flex >
                                <json-dialog-component name="Actual" title="Objecte actual" :json="log.loggable"></json-dialog-component>
                                </v-flex>
                            </v-list-tile>
                            <v-list-tile>
                                <v-flex >
                                <json-dialog-component name="Nou" title="Objecte nou" :json="JSON.parse(log.new_loggable)"></json-dialog-component>
                                </v-flex>
                            </v-list-tile>
                            <v-list-tile>
                                <v-flex >
                                <json-dialog-component name="Àntic" title="Objecte en el moment de la modificació"  :json="JSON.parse(log.old_loggable)"></json-dialog-component>
                                </v-flex>
                            </v-list-tile>

                            <v-list-tile>
                                <v-flex >
                                <v-btn icon :href="log.module.href" :target="log.module.target">
                                <v-icon :title="'Mòdul ' + log.module.text">{{ log.module.icon }}</v-icon>
                                </v-btn>
                                </v-flex>
                            </v-list-tile>
                            <v-list-tile>
                                <v-flex >
                                <v-icon :title="'Acció: ' + log.action.text">{{ log.action.icon }}</v-icon>
                                </v-flex>
                            </v-list-tile>

                        </v-list>

                    </v-card>
                </v-timeline-item>

            </v-data-iterator>
        </v-timeline>

    </v-container>
</template>

<script>
import FullScreenDialog from '../ui/FullScreenDialog'
import JsonDialogComponent from '../ui/JsonDialogComponent'
import CompareValuesComponent from '../ui/CompareValuesComponent'
import ChangelogSettings from './ChangelogSettingsComponent'
import UserAvatar from '../ui/UserAvatarComponent'

export default {
  name: 'DataIteratorChangelogMobile',
  data () {
    return {
      dataTasks: this.tasks,
      settingsDialog: false,
      refreshing: false,
      dataLogs: this.logs,
      realTime: true,
      rowsPerPageItems: [ 10, 25, 50, 100, 500, 1000, { 'text': 'Tots', 'value': -1 } ],
      pagination: {
        rowsPerPage: 10
      }
    }
  },
  props: {

    search: {
      type: String,
      required: true
    },
    logs: {
      type: Array,
      required: true
    },
    users: {
      type: Array,
      required: true
    },
    channel: {
      type: String,
      default: 'App.Log'
    },
    title: {
      type: String,
      default: 'Registre de canvis'
    },
    returnUrl: {
      type: String,
      default: null
    },
    refreshUrl: {
      type: String,
      default: '/api/v1/changelog'
    }

  },
  components: {
    'fullscreen-dialog': FullScreenDialog,
    'json-dialog-component': JsonDialogComponent,
    'compare-values': CompareValuesComponent,
    'changelog-settings': ChangelogSettings,
    'user-avatar': UserAvatar

  },
  watch: {
    tasks (tasks) {
      this.dataTasks = tasks
    }

  },
  computed: {
    timeline () {
      return this.dataLogs.slice().reverse()
    }
  },
  methods: {
    remove (task) {
      this.$emit('removed', task)
    },
    update (task) {
      // console.log(task)
      // this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
      // this.tasks = this.dataTasks
      this.$emit('updated', task)
    },
    refresh () {
      this.$emit('refresh', true)
    }
  }
}
</script>

<style scoped>

</style>
