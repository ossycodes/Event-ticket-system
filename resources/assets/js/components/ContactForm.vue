<template>
  <div>
    
    <form @submit.prevent="submit">
      <div class="alert alert-success" v-if="successResp">
        <strong>
          {{ successResp }}
          <br>
          <br>
        </strong>
      </div>

      <div v-if="errors.name" class="alert alert-danger">
        <strong>
          {{ errors.name[0] }}
          <br>
          <br>
        </strong>
      </div>

      <div v-if="errors.email" class="alert alert-danger">
        <strong>
          {{ errors.email[0] }}
          <br>
          <br>
        </strong>
      </div>

      <div v-if="errors.message" class="alert alert-danger">
        <strong>
          {{ errors.message[0] }}
          <br>
          <br>
        </strong>
      </div>

      <div v-if="errors.phonenumber" class="alert alert-danger">
        <strong>
          {{ errors.phonenumber[0] }}
          <br>
          <br>
        </strong>
      </div>

      <div class="col-md-6 contact-left">
        <input type="text" placeholder="name" name="name" required v-model="name">
        <input type="text" placeholder="email" name="email" required v-model="email">
        <input type="text" placeholder="Phone" name="phonenumber" required v-model="phonenumber">
      </div>

      <div class="col-md-6 contact-right">
        <textarea placeholder="Message" name="message" required v-model="message"></textarea>
        <input type="submit" value="SEND">
      </div>

      <div class="clearfix"></div>
    </form>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      name: null,
      email: null,
      phonenumber: null,
      message: null,
      successResp: null,
      errors: {}
    };
  },
  computed: {
    isValid() {
      return this.errors.length === 0;
    }
  },
  methods: {
    submit() {
      axios
        .post("/contactus", {
          name: this.name,
          email: this.email,
          message: this.message,
          phonenumber: this.phonenumber
        })
        .then(res => {
          this.successResp =
            "Message sent, we would get back to you shortly...";
          this.name = "";
          this.email = "";
          this.message = "";
          this.phonenumber = "";
          this.errors = {};
        })
        .catch(error => {
          this.errors = {};
          this.successResp = "";
          this.errors = error.response.data.errors;
        });
    }
  }
};
</script>

<style>
#formss {
  display: block;
  margin-top: 0em;
  box-sizing: border-box;
  padding: 0;
  margin: 0;
  font-family: "Open Sans", sans-serif;
  background: #fff;
  font-size: 14px;
  line-height: 1.42857143;
  color: #333;
  background-color: #fff;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  box-sizing: border-box;
}
</style>

ubard
ubard2018
