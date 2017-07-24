<template lang="html">
  <div class="uk-offcanvas-content">
    <img src="assets/back.jpg" class="bg" alt="">

    <transition name="fade" mode="in-out">
      <div class="loading-container" v-if="appState.ajaxQueue">
        <div class="loading-screen uk-position-center uk-box-shadow-medium uk-card-default" style="z-index: 101;">
          <div class="uk-card-body uk-text-center uk-padding-remove">
            <h3 class="uk-margin uk-padding" v-if="!appState.errorMessages.length">
              <div uk-spinner></div>
              Loading...
            </h3>
            <div class="uk-alert-danger uk-padding" uk-alert v-else>
                <i class="fa fa-warning fa-3x" aria-hidden="true"></i>
                <h3 class="uk-text-danger uk-margin-remove-top">Something went wrong</h3>
                <div class="uk-tile uk-tile-muted uk-padding-small">
                  <p v-for="(message, index) in appState.errorMessages">
                    {{ message }}
                  </p>
                </div>
                <a @click="reload" class="uk-button uk-button-danger uk-margin-small uk-width-1-1">Main page</a>
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
      if(this.settings.selected_program == 0) {
        this.started = 2;
      } else {
        this.started = 1;
      }
    });

    this.getCategories();

  },

  mounted() {
    this.clearErrors();
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
      'clearErrors',
    ]),

    reload() {
      window.location = '/';
    },

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

  .loading-screen {
    position: fixed;

    background-color: #fff;
    z-index: 9999;
    opacity: 1 !important;

  }


  .loading-container {
    position: fixed;
    z-index: 999;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0,0,0,0.8);
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
