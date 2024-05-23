<template>
  <div class="container mt-5">
    <h1 class="text-center mb-4">To Do List</h1>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
          <add-item-form v-on:reloadlist="getItems()" />
          <list-view
            :items="items"
            v-on:reloadlist="getItems()"
            class="text-center"
          />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
const axios = require("axios");

import addItemForm from "./components/addItemForm.vue";
import listView from "./components/listView.vue";

import {Utility} from "./utility";

export default {
  components: {
    addItemForm,
    listView
  },

  data: function() {
    return {
      items: [],
      utility: new Utility()
    };
  },
  methods: {
    notification (config) {
      UIkit.notification({
        pos: "top-right",
        timeout: 5000,
        ...config,
      })
    },
    error (message) {
      this.notification({
        message,
        status: "danger",
      })
    },
    getItems() {
      axios
        .get("/task/index")
        .then(res => {
          if (res.data.status === 'error') {
            this.utility.error(res.data.message);
            return;
          }
          this.items = res.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  created() {
    this.getItems();
  }
};
</script>
