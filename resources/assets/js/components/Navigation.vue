<template lang="html">
  <div>
    <nav class="uk-navbar-container uk-box-shadow-large" uk-navbar>
      <div class="uk-navbar-left uk-hidden@s" uk-sticky="animation: uk-animation-slide-top; top: 0;">
        <a class="uk-navbar-toggle floating-hamburger" href="#" uk-toggle="target: #mobile-menu">
          <span class="uk-margin-small-left" uk-icon="icon: menu"></span> <span class="uk-margin-small-left"></span>
        </a>
      </div>
      <a class="uk-position-center uk-navbar-item uk-logo uk-padding uk-text-bold uk-text-primary" href="#">
        <i class="fa fa-bolt" aria-hidden="true"></i>

        <em>fitW3</em>
      </a>

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

      <div class="uk-navbar-right uk-visible@s">
        <ul class="uk-navbar-nav">
          <li>
            <a @click.prevent="logout">
              <div class="uk-text-center menu-item">
                <span class="uk-margin-remove" uk-icon="icon: trash"></span>
                <div class="uk-navbar-subtitle">Log out</div>
              </div>
            </a>
          </li>
        </ul>
      </div>

    </nav>





    <div id="mobile-menu" uk-offcanvas="mode: push; overlay: true">
      <div class="uk-offcanvas-bar uk-flex uk-flex-column">

        <span class="uk-h2">Menu</span>
        <ul class="uk-nav uk-nav-primary uk-nav-center uk-text-left" v-for="item in menuItems" :key="item.title">
          <li @click="closeMenu" class="menu-item"><router-link :to="item.link" exact><span class="uk-margin-small-right" :uk-icon="`icon: ${item.icon}`"></span> {{ item.title }}</router-link></li>
        </ul>

        <ul class="uk-nav uk-nav-default uk-margin-top">
          <li class="uk-nav-divider"></li>
          <li><a @click.prevent="logout"><span class="uk-margin-small-right" uk-icon="icon: trash"></span> Log out</a></li>
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
            title: 'Home',
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

          // {
          //   title: 'Settings',
          //   link: '/settings',
          //   icon: 'cog',
          // },
        ],
    }
  },

  mounted() {
  },

  methods: {
    closeMenu () {
      UIkit.offcanvas('#mobile-menu').toggle();
    },

    logout() {
      axios.post('/logout')
        .catch(() => {
          location.reload();
        });
    },
  }
}
</script>

<style lang="css" scoped>

  .floating-hamburger {
      background-color: #0e1e1e;
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
