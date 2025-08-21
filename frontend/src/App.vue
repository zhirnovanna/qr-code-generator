<template>
  <div id="app">
    <QrGenerator />
  </div>
</template>

<script>
import QrGenerator from "./components/QrGenerator.vue";

export default {
  components: {
    QrGenerator,
  },
};
</script>

<style scoped>

html, body, #app {
  margin: 0;
  padding: 0;
  height: 100%;
  width: 100%;
}
</style>
