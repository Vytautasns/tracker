<template lang="html">
  <div>
    <nav class="uk-navbar-container uk-box-shadow-small" uk-navbar>
      <div class="uk-navbar-left uk-hidden@s" uk-sticky="animation: uk-animation-slide-top; top: 0;">
        <a class="uk-navbar-toggle floating-hamburger" href="#" uk-toggle="target: #offcanvas-push">
          <span class="uk-margin-small-left" uk-icon="icon: menu"></span> <span class="uk-margin-small-left"></span>
        </a>
      </div>
      <!-- <a class="uk-position-center uk-navbar-item uk-logo uk-padding-small" href="#">fitW3</a> -->

      <div class="uk-navbar-left uk-visible@s">
        <ul class="uk-navbar-nav" v-for="item in menuItems" :key="item.title">
          <li>
            <router-link :to="item.link" exact>
                   <div class="uk-text-center menu-item">
                       <span class="uk-margin-remove" :uk-icon="`icon: ${item.icon}`"></span>
                       <div class="uk-navbar-subtitle">{{ item.title }}</div>
                   </div>
               </router-link>
          </li>
        </ul>
      </div>
    </nav>



    <div id="offcanvas-push" uk-offcanvas="mode: push; overlay: true">
      <div class="uk-offcanvas-bar">

        <ul class="uk-nav uk-nav-default">
          <li class="uk-nav-header">Menu</li>
        </ul>

        <ul class="uk-nav uk-nav-default" v-for="item in menuItems" :key="item.title">
          <li class="menu-item"><router-link :to="item.link" exact><span class="uk-margin-small-right" :uk-icon="`icon: ${item.icon}`"></span> {{ item.title }}</router-link></li>
        </ul>

        <ul class="uk-nav uk-nav-default">
          <li class="uk-nav-divider"></li>
          <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: trash"></span> Log out</a></li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {

  data() {
    return {
        menuItems: [
          {
            title: 'Dashboard',
            link: '/',
            icon: 'home',
          },

          {
            title: 'Programs',
            link: '/programs',
            icon: 'star',
          },

          {
            title: 'Exercises',
            link: '/exercises',
            icon: 'thumbnails',
          },

          {
            title: 'Show',
            link: '/workout',
            icon: 'happy',
          },

          {
            title: 'Exercise details',
            link: '/details',
            icon: 'check',
          },

          {
            title: 'Logger',
            link: '/log',
            icon: 'history',
          },

          {
            title: 'Days',
            link: '/days',
            icon: 'calendar',
          },

          {
            title: 'Settings',
            link: '/settings',
            icon: 'cog',
          },
        ],
    }
  },

  mounted() {
  },
}
</script>

<style lang="css" scoped>
  .floating-hamburger {
      background-color: #e1e1e1;
      opacity: 0.8;
  }

  .uk-navbar-container {

    background-color: #0e1e1e;
  }

  .menu-item {
    transition: all 1s linear;
  }

  .router-link-active {
    border-bottom: 2px solid blue;
  }
</style>
