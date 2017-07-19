<template lang="html">
  <!-- <div class="uk-offcanvas-content background-image"> -->
  <div class="uk-offcanvas-content">
    <img src="assets/back.jpg" class="bg" alt="">
    <Navigation></Navigation>

    <transition name="fade" mode="in-out">
      <div class="loading-container" v-if="appState.ajaxQueue">
        <div class="loading-screen uk-overlay-primary uk-position-center uk-card uk-card-default">
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


    <transition name="slide-fade" mode="out-in">
      <router-view></router-view>
    </transition>
  </div>
</template>

<script>
import Navigation from './components/Navigation';

import { mapGetters, mapActions } from 'vuex';

export default {

  components: { Navigation, },

  data() {
    return {
    }
  },

  created() {
    this.getUser();
    this.getCategories();

  },

  mounted() {

  },

  watch: {
    'appState.notification': 'notify',
  },

  computed: {
    ...mapGetters([
      'appState',
      'user',
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
    opacity: 0
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
    /*transform: translateY(0px);*/
    transition: all 0.1s linear;

    opacity: 0;
  }
</style>
