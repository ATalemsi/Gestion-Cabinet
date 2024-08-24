
<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
import inactivityMixin from './inactivityMixin';

export default {
  name: 'App',
  mixins: [inactivityMixin],
  data() {
    return {
      isTabClosing: false,
    };
  },
  created() {
    document.addEventListener('visibilitychange', this.handleVisibilityChange);
    window.addEventListener('beforeunload', this.handleBeforeUnload);
  },
  methods: {
    handleVisibilityChange() {
      if (document.visibilityState === 'hidden') {
        this.isTabClosing = true;
      } else {
        this.isTabClosing = false;
      }
    },
    handleBeforeUnload(event) {
      if (this.isTabClosing) {
        localStorage.removeItem('token'); // Replace 'token' with your actual key
        localStorage.removeItem('role');  // Replace 'role' with your actual key
      }
    }
  },
  beforeDestroy() {
    document.removeEventListener('visibilitychange', this.handleVisibilityChange);
    window.removeEventListener('beforeunload', this.handleBeforeUnload);
  }
};
</script>
