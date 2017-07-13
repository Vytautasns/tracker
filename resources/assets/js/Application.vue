<template lang="html">
  <div class="uk-offcanvas-content">
    <Navigation></Navigation>

    <transition name="fade" mode="in-out">
      <div class="loading-screen" v-if="appState.ajaxQueue">
        <div class="uk-position-center uk-padding uk-margin">
          <h1><div uk-spinner></div> Loading...</h1>
        </div>
      </div>
    </transition>

    <div class="uk-alert-danger" uk-alert v-if="appState.errorMessage">
        <a class="uk-alert-close" uk-close></a>
        <p>{{ appState.errorMessage }}</p>
    </div>
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
            pos: 'top-center'
        });
      }
    },

  },


}
</script>

<style lang="css">
  .loading-screen {
    position: fixed;
    top: 0; left: 0;
    width: 100vw;
    height: 100vh;
    background-color: #fff;
    z-index: 9999;
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
