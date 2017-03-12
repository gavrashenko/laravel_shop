<template>
  <div id="cart" class="span3 breadcrumbs">

    &#x1f6d2; Я корзинка, жду игрушки {{test}} :)

  </div>
</template>

<script>
export default {
  data () {
    return {
        test: 22
    }
  }
}
</script>

<style>
  #cart {
    float: right;
  }
</style>
