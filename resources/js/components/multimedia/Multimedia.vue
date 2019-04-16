<template>
    <span>

        <v-flex>
            <v-layout column justify-center class="mb-3">
                <v-card color="primary">
                    <v-card-text class="text-xs-center white--text">VIDEO</v-card-text>
                </v-card>
            </v-layout>
            <v-layout row justify-center>
                <video id="video" src="http://clips.vorwaerts-gmbh.de/VfE_html5.mp4" preload="auto" controls></video>
            </v-layout>
            <v-layout row justify-center>
                <v-btn @click="play('video')" small>
                    Play
                </v-btn>
                <v-btn @click="pause('video')" small>
                    Pause
                </v-btn>
                 <v-btn @click="upVol('video')" small>
                    Vol +
                </v-btn>
                <v-btn @click="downVol('video')" small>
                    Vol -
                </v-btn>
                <v-btn @click="moveStart('video')" small>
                    Start
                </v-btn>
                <v-btn @click="moveEnd('video')" small>
                    End
                </v-btn>

            </v-layout>
            <v-layout row justify-center>
                   <v-btn @click="moveBackward('video')" small>
                    Backward
                </v-btn>
                <v-btn @click="moveForward('video')" small>
                    Forward
                </v-btn>
                   <v-btn @click="loopMoveBackward('video')" small>
                    Loop Backward
                </v-btn>
                   <v-btn @click="stopBackward('video')" small>
                    Stop Backward
                </v-btn>
                <v-btn @click="loopMoveForward('video')" small>
                    Loop Forward
                </v-btn>

                <v-btn @click="stopForward('video')" small>
                    Stop Forward
                </v-btn>
            </v-layout>
              <v-layout column justify-center class="mb-3 mt-3">
                <v-card color="primary">
                    <v-card-text class="text-xs-center white--text">AUDIO</v-card-text>
                </v-card>
            </v-layout>
               <v-layout row justify-center>
                <audio id="audio"
                       src="https://upload.wikimedia.org/wikipedia/commons/7/7f/OldMalagasyLullabyInyHonoIzyRavoronaTakeHerHimWithYouOBirdSteelStringValiha.ogg"
                       preload="auto" controls></audio>
                </v-layout>
              <v-layout row justify-center>
                <v-btn @click="play('audio')" small>
                    Play
                </v-btn>
                <v-btn @click="pause('audio')" small>
                    Pause
                </v-btn>
                 <v-btn @click="upVol('audio')" small>
                    Vol +
                </v-btn>
                <v-btn @click="downVol('audio')" small>
                    Vol -
                </v-btn>
                <v-btn @click="moveStart('audio')" small>
                    Start
                </v-btn>
                <v-btn @click="moveEnd('audio')" small>
                    End
                </v-btn>
                </v-layout>
            <v-layout row justify-center>
                   <v-btn @click="moveBackward('audio')" small>
                    Backward
                </v-btn>
                <v-btn @click="moveForward('audio')" small>
                    Forward
                </v-btn>
                   <v-btn @click="loopMoveBackward('audio')" small>
                    Loop Backward
                </v-btn>
                   <v-btn @click="stopBackward('audio')" small>
                    Stop Backward
                </v-btn>
                <v-btn @click="loopMoveForward('audio')" small>
                    Loop Forward
                </v-btn>

                <v-btn @click="stopForward('audio')" small>
                    Stop Forward
                </v-btn>
            </v-layout>

        </v-flex>

    </span>

</template>

<script>
  var videoIntervalBackward, audioIntervalBackward

  export default {

    name: 'Multimedia',
    data() {
      return {
        value: ''
      }
    },
    methods: {

      play(type) {
        var video = document.getElementsByTagName(type)[0]
        video.play()
      },
      pause(type) {
        var video = document.getElementsByTagName(type)[0]

        video.pause()
      },
      upVol(type) {
        var video = document.getElementsByTagName(type)[0]
        if (video.volume + 0.1 >= 1) {
          video.volume = 1
        } else {
          video.volume += 0.1
        }
      },
      downVol(type) {
        var video = document.getElementsByTagName(type)[0]
        if (video.volume - 0.1 <= 0) {
          video.volume = 0
        } else {
          video.volume -= 0.1
        }
      },
      moveForward(type) {
        var video = document.getElementsByTagName(type)[0]
        if (video.currentTime + 3 >= video.duration) {
          video.currentTime = video.duration
        } else {
          video.currentTime += 3
        }
      },
      moveBackward(type) {
        var video = document.getElementsByTagName(type)[0]
        if (video.currentTime - 3 <= 0) {
          video.currentTime = 0
        } else {
          video.currentTime -= 3
        }
      },
      loopMoveForward(type) {
        var video = document.getElementsByTagName(type)[0]
        video.playbackRate = 4.0
        // while (video.currentTime + 3 <= video.duration) {
        //   video.currentTime += 3
        // }
        // video.currentTime = video.duration
      },
      loopMoveBackward(type) {
        var video = document.getElementsByTagName(type)[0]
        if (type == 'video') {
          this.videoIntervalBackward = setInterval(function () {
            video.currentTime -= 0.1
          }, 30)
        } else {
          this.audioIntervalBackward = setInterval(function () {
            video.currentTime -= 0.1
          }, 70)
        }
      },
      moveStart(type) {
        var video = document.getElementsByTagName(type)[0]

        video.currentTime = 0
      },
      moveEnd(type) {
        var video = document.getElementsByTagName(type)[0]
        video.currentTime = video.duration
      },
      stopBackward(type) {
        if (type == 'video') {
          clearInterval(this.videoIntervalBackward)
        } else {
          clearInterval(this.audioIntervalBackward)
        }
      },
      stopForward(type) {
        var video = document.getElementsByTagName(type)[0]
        video.playbackRate = 1.0
      }

    }
  }
</script>

<style scoped>

</style>
