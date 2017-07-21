<template lang="html">
  <div class="uk-offcanvas-content">
    <img src="assets/back.jpg" class="bg" alt="">

    <transition name="fade" mode="in-out">
      <div class="loading-container" v-if="appState.ajaxQueue">
        <div class="loading-screen uk-overlay-primary uk-position-center uk-card uk-card-default" style="z-index: 101;">
          <div class="uk-card-body">
            <h3>
              <div uk-spinner></div>
              Loading...
            </h3>
            <div class="uk-alert-danger" uk-alert v-if="appState.errorMessage">
                <a class="uk-alert-close" uk-close></a>
                <p>{{ appState.errorMessage }}</p>
            </div>
          </div>
        </div>
      </div>


    </transition>

      <div v-if="started === 1">
        <Navigation></Navigation>

        <transition name="slide-fade" mode="out-in">
          <router-view></router-view>
        </transition>
      </div>
      <div class="loading-container" v-else-if="started === 2">
        <Setup></Setup>
      </div>



  </div>
</template>

<script>
import Navigation from './components/Navigation';
import Setup from './pages/app/Setup';
import { mapGetters, mapActions } from 'vuex';

export default {

  components: { Navigation, Setup },

  data() {
    return {
      started: 0,
    }
  },

  created() {

    this.getUser().then(() => {
      if(this.settings.first_login == 1) {
        this.started = 2;
      } else {
        this.started = 1;
      }
    });

    this.getCategories();

  },

  mounted() {

  },

  watch: {
    'appState.notification': 'notify',
    // 'appState.ajaxQueue': function () {
    //     if (this.appState.ajaxQueue > 0) {
    //       this.started = false;
    //     } else {
    //       this.started = true;
    //     }
    // },
  },

  computed: {
    ...mapGetters([
      'appState',
      'user',
      'settings',
    ]),

  },

  methods: {
    ...mapActions([
      'getUser',
      'makeNotification',
      'getCategories',
    ]),

    notify() {
      if (this.appState.notification) {
        UIkit.notification({
            message: this.appState.notificationMessage,
            status: 'primary',
            pos: 'bottom-center',
            timeout: 1000,
        });
      }
    },

  },


}
</script>

<style lang="css">

  /*.loading-screen {
    position: fixed;
    top: 5%; left: 5%;
    width: 80%;
    height: 80%;
    background-color: #fff;
    z-index: 9999;
    -webkit-box-shadow: 0px 0px 300px 200px rgba(0,0,0,0.55);
    -moz-box-shadow: 0px 0px 300px 200px rgba(0,0,0,0.55);
    box-shadow: 0px 0px 300px 200px rgba(0,0,0,0.55);
  }*/

  .loading-container {
    position: fixed;
    z-index: 99999999;
    width: 100vw;
    height: 100vh;
  }


  .fade-enter-active, .fade-leave-active {
  transition: opacity 0.8s
  }
  .fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
    /*opacity: 0*/
  }


  .slide-fade-enter-active {
    transition: all 0.1s linear;
  }
  .slide-fade-leave-active {
    transition: all 0.1s linear;
    // opacity: 0;
  }
  .slide-fade-enter, .slide-fade-leave-to
  /* .slide-fade-leave-active for <2.1.8 */ {
    transform: translateY(-50px);
    opacity: 0;
  }
</style>
