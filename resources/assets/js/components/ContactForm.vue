<template>
  <div>
    <div class="alert alert-success" v-show="successResp !== ''">
      <button type="button" class="close" data-dismiss="alert">x</button>
      <strong>
        {{ successResp }}
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
        {{ err.name[0] }}
        {{ err.email[0] }}
        {{ err.phonenumber[0] }}
        {{ err.message[0] }}
        <br>
        <br>
      </strong>
    </div>

    <!-- <div
      class="alert alert-danger"
      v-show="formIsValid"
      v-for="err in errors"
      :key="errors.indexOf(err)"
    >
      <button type="button" class="close" data-dismiss="alert">x</button>
      <strong>
          Please fill in all fields.
        <br>
        <br>
      </strong>
    </div>-->

    <div class="col-md-6 contact-left">
      <input type="text" placeholder="name" name="name" v-model="name" required>
      <input type="text" placeholder="email" name="email" v-model="email" required>
      <input type="text" placeholder="Phone" name="phonenumber" v-model="phone" required>
    </div>

    <div class="col-md-6 contact-right">
      <textarea placeholder="Message" name="message" v-model="message" required></textarea>
      <input type="submit" @click="sendContactFormMessage()" :disabled="formIsValid()" value="SEND">
    </div>

    <div class="clearfix"></div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  mounted() {
    console.log("mounted");
  },
  data() {
    return {
      name: "",
      email: "",
      phone: "",
      message: "",
      errors: [],
      successResp: ""
    };
  },
  methods: {
    sendContactFormMessage() {
      this.successResp = "";
      this.errors = [];
      axios
        .post("/contactus", {
          name: this.name,
          email: this.email,
          phonenumber: this.phone,
          message: this.message
        })
        .then(resp => {
          this.errors = [];
          this.name = "";
          this.email = "";
          this.phone = "";
          this.message = "";
          this.successResp = resp.data.message;
          console.log(resp);
        })
        .catch(err => {
          this.successResp = "";
          if (err.response.status === 422) {
            this.errors.push(err.response.data.errors);
          }
          console.log(err.response.data.errors);
        });
    },

    formIsValid() {
        return this.name === "" && this.email === "" && this.message === "" && this.phone === "";
    }
  }
};
</script>