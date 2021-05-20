<template>
  <v-app>
    <flash-message />
    <nuxt />
  </v-app>
</template>

<script>
import flashmessage from '~/components/FlashMessage.vue'

export default {
  components:{
    flashmessage
  }
}
</script>
