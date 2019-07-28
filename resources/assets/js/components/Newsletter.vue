<template>
  <div>
    <div class="alert alert-success" v-if="message !== ''">
      <button type="button" class="close" data-dismiss="alert">x</button>
      <strong>
        {{ message }}
        <br>
        <br>
      </strong>
    </div>

    <div
      class="alert alert-danger"
      v-show="errors.length > 0"
      v-for="err in errors"
      :key="errors.indexOf(err)"
    >
      <button type="button" class="close" data-dismiss="alert">x</button>
      <strong>
        {{ err[0] }}
        <br>
        <br>
      </strong>
    </div>

    <p>
      Subscribe
      <strong>to</strong> our Newsletter
    </p>
    <input type="email" placeholder name="email" class="form-control" required v-model="email">
    <br>
    <button
      @click="subscribeToNewsLetter()"
      class="btn btn-warning"
      :disabled="!isValidForm"
    >Subscribe</button>
    <div class="clearfix"></div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      email: "",
      message: "",
      errors: []
    };
  },

  methods: {
    emailIsValid() {
      if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) {
        return true;
      } else {
        return false;
      }
    },

    subscribeToNewsLetter() {
      this.message = "";
      this.errors = [];
      axios
        .post("/newsletter", {
          email: this.email
        })
        .then(resp => {
          this.email = "";
          this.message = resp.data.status;
        })
        .catch(err => {
          if (err.response.status === 422) {
            this.email = "";
            console.log(err);
            this.errors.push(err.response.data.errors.email);
          } else {
            this.errors.push(["something went wrong, please try again later"]);
          }
        });
    }
  },

  computed: {
    isValidForm() {
      return this.emailIsValid() && this.email;
    }
  }
};
</script>
