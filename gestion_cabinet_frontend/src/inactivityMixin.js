export default {
    data() {
      return {
        inactivityTimer: null,
        inactivityTimeout: 10800000 // Set to 3 hours (10,800,000 milliseconds)
      };
    },
    methods: {
      resetInactivityTimer() {
        clearTimeout(this.inactivityTimer);
        this.inactivityTimer = setTimeout(this.handleInactivity, this.inactivityTimeout);
      },
      handleInactivity() {
        console.log('User inactive for 3 hours, logging out...');
        localStorage.removeItem('token');
        localStorage.removeItem('role');
        this.$router.push('/'); 
      }
    },
    mounted() {
      
      const events = ['mousemove', 'keydown', 'click', 'scroll'];
      events.forEach(event => window.addEventListener(event, this.resetInactivityTimer));
      this.resetInactivityTimer(); 
    },
    beforeDestroy() {
      
      const events = ['mousemove', 'keydown', 'click', 'scroll'];
      events.forEach(event => window.removeEventListener(event, this.resetInactivityTimer));
      clearTimeout(this.inactivityTimer);
    }
  };
  