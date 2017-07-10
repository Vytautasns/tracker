<template lang="html">
  <div class="uk-container">
    <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Abs</span></h2>
    <div :class="n == 99 ? 'uk-card-primary' : 'uk-card-default'" class="uk-card uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid v-for="n in 5">
        <div class="uk-width-auto uk-padding-small uk-text-center">
            <img src="assets/categories/abs.png" width="120" height="280" alt="">
        </div>
        <div class="uk-width-expand">
            <div class="uk-card-body">
                <h3 class="uk-card-title">6 weeks abs</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
}
</script>

<style lang="css">
</style>
