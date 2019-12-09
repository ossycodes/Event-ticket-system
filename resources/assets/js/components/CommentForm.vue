<template>
  <div class="blog-form" id="formhere">
    <form method="post" @submit.prevent="submit">
      <input type="hidden" name="event_id" value>
      <input type="text" class="text" placeholder value="name" v-model="name">
      <input type="text" class="text" placeholder value="email" v-model="email">
      <textarea name="message" v-model="message"></textarea>
      <input type="submit" value="SUBMIT COMMENT" class="btn btn-warning">
    </form>
  </div>
</template>

<script>
export default {
  props: ["user", "eventId"],
  data() {
    return {
      name: null,
      email: null,
      message: null,
      event_id: eventId
    };
  },
  computed: {
    authenticatedUser() {
      return JSON.parse(this.user);
    }
  },
  methods: {
    submit() {
      axios
        .post(`/events/${this.eventId}/comments`, {
          name: this.name,
          email: this.email,
          message: this.message,
          event_id: "eyJpdiI6IllNWWg4ZnRHa2VZS3U1VnpFZDhjd1E9PSIsInZhbHVlIjoibmdFRDJGTWFkVjBsVXB5UmZOTUtSQT09IiwibWFjIjoiMjUzMDBhZTcyYjNhNzUyMGE1Y2NjY2QyMmIwYzM1MjgxOWQ0YTZiNTA4MTliZTg1NGQxZjYxY2IzNWExZTlkOSJ9"
        })
        .then(res => {
          console.log(res);
        })
        .catch(error => {
          console.log(error.response.data.errors);
        });
    }
  }
};
</script>

<style>
</style>
