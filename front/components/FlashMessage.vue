<template>
  <div class="snackbar-wrapper">
    <v-snackbar
    v-model="status"
    transition="slide-y-reverse-transition"
    center
    top
    absolute
    >
      <div class="ml-5 font-weight-bold white--text">
        {{ message }}
      </div>
    </v-snackbar>
  </div>
</template>

<script>
import { mapGetters } from "vuex"
export default {
  computed: {
    ...mapGetters({
      message: "flashMessage/message",
      status: "flashMessage/status",
    }),
  },
}
</script>

<style lang="scss">
.snackbar-wrapper{
  position: absolute;
  height: 100%;
  width: 100%;
  pointer-events: none;
  top: 0;
  left: 0;
  z-index: 1000;
  .v-snack--absolute{
    z-index: 1000;
  }
}
</style>