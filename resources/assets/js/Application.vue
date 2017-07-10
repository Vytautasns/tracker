<template lang="html">
  <div class="uk-offcanvas-content">
      <Navigation></Navigation>
      <router-view></router-view>
  </div>
</template>

<script>
import Navigation from './components/Navigation';
export default {

  components: { Navigation },

  data() {
    return {

    }
  },

}
</script>

<style lang="css">
</style>
